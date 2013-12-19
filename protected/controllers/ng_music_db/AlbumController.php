<?php

/**
 * Class AlbumController
 * {DESCRIPTION}
 * Date: 16/12/13
 * Time: 12:14 AM
 * @author: Spiros Kabasakalis <kabasakalis@gmail.com>
 * @copyright Copyright &copy; Spiros Kabasakalis 2013
 * @license The MIT License  http://opensource.org/licenses/MIT
 */

class AlbumController extends CController
{

    public function filters()
    {
        return array(
            'accessControl', // perform access control for CRUD operations
            array(
                'ext.starship.RestfullYii.filters.ERestFilter +
                REST.GET, REST.PUT, REST.POST, REST.DELETE'
            ),
        );
    }


    public function actions()
    {
        return array(
            'REST.' => 'ext.starship.RestfullYii.actions.ERestActionProvider',
        );
    }

    public function accessRules()
    {
        return array(
            array('allow', 'actions' => array('REST.GET', 'REST.PUT', 'REST.POST', 'REST.DELETE'),
                'users' => array('*'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    /**
     * Returns the model assosiated with this controller.
     * The assumption is that the model name matches your controller name
     * If this is not the case you should override this method in your controller
     */
    public function getModel()
    {
        if ($this->model === null) {
            /*	$modelName = str_replace('Controller', '', get_class($this));*/
            $modelName = 'Album';
            $this->model = new $modelName;
        }
        $this->_attachBehaviors($this->model);
        return $this->model;
    }

    /**
     * Helper for loading a single model
     */
    protected function loadOneModel($id)
    {
        return $this->getModel()->with($this->nestedRelations)->findByPk($id);
    }



  protected function  unlinkAlbumFromArtist($albumid) {

            $sql = "DELETE FROM  artist_album WHERE album_id=:album_id";
            $command = Album::model()->getDbConnection()->createCommand($sql);
            $command->bindValues(array(
                ":album_id" => $albumid,
           ));
            $command->execute();
            return true;
    }


    public function restEvents()
    {

        /**
         * req.get.resources.render
         *
         * Called when a GET request for when a list resources is to be rendered
         *
         * @param (Array) (data) this is an array of models representing the resources
         * @param (String) (model_name) the name of the resources model
         * @param (Array) (relations) the list of relations to include with the data
         * @param (Int) (count) the count of records to return
         */
        $this->onRest('req.get.resources.render', function ($data, $model_name, $relations, $count) {
            //Handler for GET (list resources) request
            $this->setHttpStatus((($count > 0) ? 200 : 204));
            $this->renderJSON(array(
                'type' => 'rest',
                'success' => (($count > 0) ? true : false),
                'message' => (($count > 0) ? "Record(s) Found" : "No Record(s) Found"),
                'totalCount' => $count,
                'modelName' => $model_name,
                'relations' => $relations,
                'data' => $data,
            ));
        });


        /**
         * req.get.resource.render
         *
         * Called when a GET request for a single resource is to be rendered
         * @param (Object) (data) this is the resources model
         * @param (String) (model_name) the name of the resources model
         * @param (Array) (relations) the list of relations to include with the data
         * @param (Int) (count) the count of records to return (will be either 1 or 0)
         */
        $this->onRest('req.get.resource.render', function ($data, $model_name, $relations, $count) {
            //Handler for GET (single resource) request
            $this->setHttpStatus((($count > 0) ? 200 : 204));
            $this->renderJSON(array(
                'type' => 'rest',
                'success' => (($count > 0) ? true : false),
                'message' => (($count > 0) ? "Record Found" : "No Record Found"),
                'totalCount' => $count,
                'modelName' => $model_name,
                'relations' => $relations,
                'data' => $data,
                ));
        });





        $this->onRest('pre.filter.model.apply.put.data', function ($model, $data, $restricted_properties) {

            $artist_id = $model->artists[0]->id;
            if (in_array($artist_id, Artist::PROTECTED_ARTISTS())) {
                throw new CHttpException(403, '<i>You cannot modify </i><h4>' . $model->name .
                    '</h4><br> It\'s demo data.Feel free to create,update and delete  your own data.');
                exit;
            } else
                return [$model, $data, $restricted_properties]; //Array [Object, Array, Array]
        });

        /**
         * model.delete
         *
         * Called whenever a model resource needs deleting
         *
         * @param (Object) (model) the model resource to be deleted
         */
   /*     $this->onRest('model.delete', function ($model) {
            $artist_id = $model->artists[0]->id;
            if (in_array($artist_id, Artist::PROTECTED_ARTISTS())) {
                throw new CHttpException(403, '<i>You cannot delete </i><h4>' . $model->name .
                    '</h4><br> It\'s demo data.Feel free to create,update and delete  your own data.');
                exit;
            } else {
                if (!$model->delete()) {
                    throw new CHttpException(500, 'Could not delete model');
                }
            }
            return $model;
        });*/
        $this->onRest('model.delete', function($album) {
            $artist_id = $album->artists[0]->id;

            if (in_array($artist_id, Artist::PROTECTED_ARTISTS())) {
                throw new CHttpException(403, '<i>You cannot delete </i><h4>' . $album->name .
                    '</h4><br> It\'s demo data.Feel free to create,update and delete  your own data.');
                exit;
            }

            $tracksDeleted=true;
            $album_id=$album->id;

           $tracks=Track::model()->findAllByAttributes(array('album_id'=>$album_id));
            foreach($tracks as $track){
                $deleted=$track->delete();
                $tracksDeleted=$tracksDeleted && $deleted;
            }

            if(!$album->delete()) {
                throw new CHttpException(500, 'Could not delete model');
            }
            if(!$tracksDeleted) {
                throw new CHttpException(500, 'Some artist\'s albums were not deleted');
            }
            if(!$this->unlinkAlbumFromArtist($album_id)) {
                throw new CHttpException(500, 'Album was not unlinked from artist.');
            }

            return $album;
        });



    }

}


