/*
* We are testing artists pages.There are more pages in this app,
* for example albums for a specific artist,edit album,new album,
* tracks,new track,edit track.It should be easy to test them once you
*  get a grasp of  the following tests.Remember this is e2e,so you must provide
*   real data ,artist_name and artist_id should exist in database.
*
* */
describe("E2E: Testing  Artists Requests", function() {

    var ptor = protractor.getInstance();
    var base_url=ptor.params.BASE_URL; //your application base URLset in protractor.conf.js
var artist_name='AC/DC'; //actual artist name in your database
 var artist_id=52; //actual artist id of the above artist
    beforeEach(function() {
        var ptor = protractor.getInstance();
    });

    it('should have a working artists page', function() {
        ptor.get(base_url);
        expect(ptor.findElement(protractor.By.css('h1')).getText()).toBe('Artists');
    });

    it('should have a working '+artist_name+' details page', function() {
        ptor.get(base_url+'artist/'+artist_id);
        expect(ptor.findElement(protractor.By.binding('artist.name')).getText()).toBe(artist_name);
    });

    it('should have a working add new artist page', function() {
        ptor.get(base_url+'artist/'+'new/edit');
        expect(ptor.isElementPresent(protractor.By.name('artistForm'))).toBe(true); //form has loaded
        expect(ptor.findElement(protractor.By.name('name')).getAttribute('value')).toBe('');  //empty name  input field (since it's new artist).
    });

    it('should have a working edit artist page('+artist_name+')', function() {
        ptor.get(base_url+'artist/'+artist_id+'/edit');
        expect(ptor.isElementPresent(protractor.By.name('artistForm'))).toBe(true); //form has loaded
        expect(ptor.findElement(protractor.By.name('name')).getAttribute('value')).toBe(artist_name);  //name input  is filled with edited artist's name
    });

});