<?php

/**
 * Class ArtistController
 * {DESCRIPTION}
 * Date: 16/12/13
 * Time: 12:14 AM
 * @author: Spiros Kabasakalis <kabasakalis@gmail.com>
 * @copyright Copyright &copy; Spiros Kabasakalis 2013
 * @license The MIT License  http://opensource.org/licenses/MIT
 */

class ArtistController extends CController
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
            $modelName = 'Artist';
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



    protected function  unlinkArtistFromAlbums($artistid) {

        $sql = "DELETE FROM  artist_album WHERE artist_id=:artist_id";
        $command = Artist::model()->getDbConnection()->createCommand($sql);
        $command->bindValues(array(
            ":artist_id" => $artistid,
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


        $this->onRest('req.post.album.', function ($data) {
            //$data is the data sent in the POST
            echo CJSON::encode(array('data' => $data));
        });





        /**
         * model.delete
         *
         * Called whenever a model resource needs deleting
         *
         * @param (Object) (model) the model resource to be deleted
         */
        $this->onRest('model.delete', function($artist) {

/*print_r(Artist::PROTECTED_ARTISTS());
            print_r($artist->id);
            exit;*/

            //DON'T LET USERS  DELETE PROTECTED ARTISTS
            if (in_array($artist->id, Artist::PROTECTED_ARTISTS())) {
                throw new CHttpException(403, '<i>You cannot delete </i><h4>' . $artist->name .
                    '</h4><br> It\'s demo data.Feel free to create,update and delete  your own data.');
                exit;
            }
            $albumsDeleted=true;
            $tracksDeleted=true;
            foreach($artist->albums as $album){

                //delete tracks
                $albumid=$album->id;
                $tracks=Track::model()->findAllByAttributes(array('album_id'=>$albumid));
                foreach($tracks  as $track){
                    $trackDeleted= $track->delete();
                    $tracksDeleted=$tracksDeleted && $trackDeleted;
                }
                //delete album
               $albumdeleted=$album->delete();
                $albumsDeleted=$albumsDeleted && $albumdeleted;
            }

            if(!$artist->delete()) {
                throw new CHttpException(500, 'Could not delete model');
            }
            if(!$albumsDeleted) {
                throw new CHttpException(500, 'Some artist\'s albums were not deleted');
            }
            if(!$tracksDeleted) {
                throw new CHttpException(500, 'Some album tracks were not deleted');
            }
            if(!$this->unlinkArtistFromAlbums($artist->id)) {
                throw new CHttpException(500, 'Artist was not unlinked from albums.');
            }

            return $artist;
        });


//DON'T LET USERS  UPDATE PROTECTED ARTISTS
        $this->onRest('pre.filter.model.apply.put.data', function ($model, $data, $restricted_properties) {
            if (in_array($model->id, Artist::PROTECTED_ARTISTS())) {
                throw new CHttpException(403, '<i>You cannot modify </i><h4>' . $model->name .
                    '</h4><br> It\'s demo data.Feel free to create,update and delete  your own data.');
                exit;
            } else
                return array($model, $data, $restricted_properties); //Array [Object, Array, Array]
        });

        /**
         * model.subresources.save
         *
         * Called whenever a sub-resource is saved
         *
         * @param (Object) (model) the owner of the sub-resource
         * @param (String) (subresource_name) the name of the subresource
         * @param (Mixed/Int) (subresource_id) the primary key of the subresource
         *
         * @return (Object) the updated model representing the owner of the sub-resource
         */

        //DON'T LET USERS ADD ALBUMS TO PROTECTED ARTISTS
        $this->onRest(ERestEvent::MODEL_SUBRESOURCE_SAVE, function ($model, $subresource_name, $subresource_id) {

            if (in_array($model->id, Artist::PROTECTED_ARTISTS())) {
                Album::model()->findByPk($subresource_id)->delete(); //rollback,can't add album to protected artist
                throw new CHttpException(403, '<i>You cannot modify </i><h4>' . $model->name .
                    '</h4><br> It\'s demo data.Feel free to create,update and delete  your own data.');
                exit;
            };
            if (!$this->getSubresourceHelper()->putSubresourceHelper($model, $subresource_name, $subresource_id)) {
                throw new CHttpException('500', 'Could not save Sub-Resource');
            }
            $model->refresh();
            return true;
        });

    }

}