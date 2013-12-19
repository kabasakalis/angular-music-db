describe('Unit: Testing Resource', function () {
    window.music_db.App.defineModules();
    window.music_db.App.restangularConfig();

    beforeEach(module('ng_music_db'));

    beforeEach(inject(function ($injector) {
        $httpBackend = $injector.get('$httpBackend');
        Resource = $injector.get('Resource');
    }));

    afterEach(inject(function ($injector) {
        $httpBackend.verifyNoOutstandingExpectation();
        $httpBackend.verifyNoOutstandingRequest();
    }));

    var baseUrl = window.music_db.config.Constants.API_BASE_URL;
    var artistURL = baseUrl + '/artist';

    it('should have a registered Resource service', inject(function (Resource) {
        expect(Resource).not.toBe(null);
    }));

    it('should have a working getAll method',
        function () {
            var response = $httpBackend.expectGET(artistURL);
            response.respond({data: new Array()});
            Resource.getAll('artist');
            $httpBackend.flush();
        });

    it('should have a working create  method',
        function () {
            var newArtist = {id: 44, name: "King Diamond", "description": "Metal Legend", "country": "Denmark", "year_formed": "1985", "genre_id": "1"};
            var response = $httpBackend.expectPOST(artistURL, newArtist);
            response.respond({data: new Array()});
            Resource.create('artist', newArtist);
            $httpBackend.flush();
        });

    it('should have a working delete method',
        function () {
            var artist_id = 3;
            var response = $httpBackend.expectDELETE(artistURL + '/' + artist_id);
            response.respond({data: new Array()});
            Resource.delete('artist', artist_id);
            $httpBackend.flush();
        });

    it('should have a working getById method',
        function () {
            var artist_id = 3;
            var response = $httpBackend.expectGET(artistURL + '/' + artist_id);
            response.respond({data: new Array()});
            Resource.getById('artist', artist_id);
            $httpBackend.flush();
        });

    it('should have a working save method',
        function () {
            var savedArtist = {id: 44, name: "King Diamond", "description": "Metal Legend", "country": "Denmark", "year_formed": "1985", "genre_id": "1"};
            var response = $httpBackend.expectPUT(artistURL + '/' + savedArtist.id, savedArtist);
            response.respond({data: new Array()});
            Resource.save('artist', savedArtist);
            $httpBackend.flush();
        });

    it('should have a working linkResourceToRelated method',
        function () {
            var artist = {id: 44, name: "King Diamond", "description": "Metal Legend", "country": "Denmark", "year_formed": "1985", "genre_id": "1"};
            var album = {id: 1, name: 'Them', year_release: 1988, genre_id: 1, picture_id: null};
            var response = $httpBackend.expectPUT(artistURL + '/' + artist.id + '/albums/' + album.id);
            response.respond({data: new Array()});
            Resource.linkResourceToRelated('artist', 44, 'album', 1);
            $httpBackend.flush();
        });

    it('should have a working getAllRelatedByResourceId method',
        function () {
            var artist_id = 44;
            var response = $httpBackend.expectGET(artistURL + '/' + artist_id + '/albums');
            response.respond({data: new Array()});
            Resource.getAllRelatedByResourceId('artist', artist_id, 'album'); //get all albums of artist with id artist_id
            $httpBackend.flush();
        });
});
