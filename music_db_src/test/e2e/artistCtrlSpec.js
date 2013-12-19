/*
*  E2E Test For  ArtistCtrl.
*  We confirm that artists are loaded in the table. (You must know how many artists are  expected  in your table,
*  this is not always  the total artists number,since you have pagination.Variable number_of_artists_expected
*  is the variable that holds the expected artist rows number in the table.You should also define name and id values for an existing artist,
*  to test the table edit and details navigation buttons.You must also edit the domain  and base url for your application.
* */

describe("E2E: Testing ArtistCtrl", function () {


    var ptor = protractor.getInstance();

    var base_url=ptor.params.BASE_URL; //your application base URLset in protractor.conf.js
    var domain =ptor.params.DOMAIN;  //your domain set in protractor.conf.js
    var artist_name = 'AC/DC'; //actual artist name in your database
    var artist_id = 52; //actual artist id of the above artist
    var number_of_artists_expected = 7;//set this to the size of your table pagination,or the number of artists loaded on startup.

    var edit_URI = 'artist/' + artist_id + '/edit';
    var add_URI = 'artist/new/edit';
    var details_URI = 'artist/'+ artist_id;

    beforeEach(function () {
        var ptor = protractor.getInstance();
    });

    it('should load ' + number_of_artists_expected + ' artists in the table', function () {
        ptor.get(base_url);
        var number_of_artists_table_rows;
        ptor.findElements(protractor.By.repeater('item in artistPagination.list')).then(function (array) {
            number_of_artists_table_rows = array.length;
            expect(number_of_artists_table_rows).toEqual(number_of_artists_expected);
        });
    });

    it('should navigate to edit form page for ' + artist_name + ' when edit button is clicked', function () {
        ptor.get(base_url);
        ptor.findElement(protractor.By.id('edit_' + artist_id)).click().then(function (url) {
            ptor.getCurrentUrl(url).then(function (url) {
                    expect(url).toEqual(domain + base_url + edit_URI);
                });
        })
    });

    it('should navigate to form for new artist page  when Add button is clicked', function () {
        ptor.get(base_url);
        ptor.findElement(protractor.By.id('add_artist')).click().then(function (url) {
            ptor.getCurrentUrl(url).then(function (url) {
                expect(url).toEqual(domain + base_url + add_URI);
            });
        })
    });

    it('should navigate to artist details page when Details button is clicked', function () {
        ptor.get(base_url);
        ptor.findElement(protractor.By.id('details_' + artist_id)).click().then(function (url) {
            ptor.getCurrentUrl(url).then(function (url) {
                expect(url).toEqual(domain + base_url + details_URI);
            });
        })
    });

});