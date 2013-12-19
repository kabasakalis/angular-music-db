<?php

class m131217_123045_music_db extends CDbMigration
{
	public function up()
	{

        $this->execute("
        CREATE TABLE IF NOT EXISTS `album` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL,
  `year_release` year(4) DEFAULT NULL,
  `genre_id` int(11) DEFAULT NULL,
  `picture_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_genre_idx` (`genre_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=121 ;




INSERT INTO `album` (`id`, `name`, `year_release`, `genre_id`, `picture_id`) VALUES
(1, 'Them', 1988, 1, NULL),
(2, 'Abigail', 1982, 1, NULL),
(3, 'Trunk Muzik Returns', 2013, 4, NULL),
(29, 'Back In Black', 1980, NULL, NULL),
(34, 'For Those About To Rock', 1981, NULL, NULL),
(53, 'Unstoppable Force', 1987, NULL, NULL),
(73, 'High Voltage', 1975, NULL, NULL),
(74, 'T.N.T.', 1975, NULL, NULL),
(75, 'Dirty Deeds Done Dirt Cheap', 1976, NULL, NULL),
(76, 'Let There Be Rock', 1977, NULL, NULL),
(77, 'Powerage', 1978, NULL, NULL),
(78, 'Highway to Hell', 1979, NULL, NULL),
(79, 'Flick of the Switch', 1983, NULL, NULL),
(80, 'Fly on the Wall', 1985, NULL, NULL),
(81, 'Who Made Who', 1986, NULL, NULL),
(82, 'Blow Up Your Video', 1988, NULL, NULL),
(83, 'The Razors Edge', 1990, NULL, NULL),
(84, 'Ballbreaker', 1995, NULL, NULL),
(85, 'Stiff Upper Lip', 2000, NULL, NULL),
(86, 'Black Ice', 2008, NULL, NULL),
(87, 'Fatal Portrait', 1986, NULL, NULL),
(88, 'Conspiracy', 1989, NULL, NULL),
(89, 'The Eye', 1990, NULL, NULL),
(90, 'The Spider''s Lullabye', 1995, NULL, NULL),
(91, 'The Graveyard', 1996, NULL, NULL),
(92, 'Voodoo', 1998, NULL, NULL),
(93, 'House of God', 2000, NULL, NULL),
(94, 'Abigail II: The Revenge', 2002, NULL, NULL),
(95, 'The Puppet Master', 2003, NULL, NULL),
(96, 'Give Me Your Soul...Please', 2007, NULL, NULL),
(97, 'Trunk Muzik 0-60', 2010, NULL, NULL),
(98, 'Radioactive', 2011, NULL, NULL),
(99, 'Psycho White', 2012, NULL, NULL),
(100, 'Love story', 2014, NULL, NULL),
(101, 'Skeptics Apocalypse', 1985, NULL, NULL),
(102, 'Mad Locust Rising', 1986, NULL, NULL),
(103, 'Omega Conspiracy', 1999, NULL, NULL),
(104, 'Order of the Illuminati', 2003, NULL, NULL),
(105, 'Alienigma', 2007, NULL, NULL),
(106, 'Katy Hudson', 2001, NULL, NULL),
(107, 'One of the Boys', 2008, NULL, NULL),
(108, 'Teenage Dream', 2010, NULL, NULL),
(109, 'Prism', 2013, NULL, NULL),
(110, 'Justified', 2002, NULL, NULL),
(111, 'FutureSex/LoveSounds', 2006, NULL, NULL),
(112, 'The 20/20 Experience 1/2', 2013, NULL, NULL),
(113, 'The 20/20 Experience 2/2', 2013, NULL, NULL),
(114, 'Supa Dupa Fly', 1997, NULL, NULL),
(115, 'Da Real World', 1999, NULL, NULL),
(116, 'Miss E... So Addictive', 2001, NULL, NULL),
(117, 'Under Construction', 2002, NULL, NULL),
(118, 'This Is Not a Test!', 2003, NULL, NULL),
(119, 'The Cookbook', 2005, NULL, NULL),
(120, 'Block Party', NULL, NULL, NULL);

CREATE TABLE IF NOT EXISTS `artist` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `description` text,
  `country` varchar(45) DEFAULT NULL,
  `year_formed` year(4) DEFAULT NULL,
  `genre_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `name` (`name`),
  KEY `FK_artist_genre_idx` (`genre_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=302 ;



INSERT INTO `artist` (`id`, `name`, `description`, `country`, `year_formed`, `genre_id`) VALUES
(44, 'King Diamond', 'King Diamond is a Danish heavy metal band formed in 1985 by vocalist King Diamond, guitarists Andy LaRocque and Michael Denner, bassist Timi Hansen and drummer Mikkey Dee. Diamond, Denner and Hansen had recently departed the group Mercyful Fate, and decided to form a new band under the King Diamond moniker, as it was already known from the Mercyful Fate days.[1][2] In 1985, King Diamond released their debut album Fatal Portrait. Since then the band have released a total of twelve studio albums (most of them concept albums), two live albums, two extended plays, five compilations and five singles.atrical Heavy Metal', 'Denmark', 1985, 1),
(45, 'Agent Steel', 'Agent Steel is an American speed metal band from Los Angeles, California that was formed in 1984 by singer John Cyriis (birth name disputed, possibly João Campos or Jean Pierre), and drummer Chuck Profus. The band released two full length albums, and one EP before disbanding in 1988. They were most notable for John Cyriis''s high-pitched vocals, catchy songs, melodic riffs, and fast tempos mixed in with their unusual (in heavy metal) UFOs, and differential anthropology[1] -as the band''s song]/lyrical themes. The band reformed in 1999 and has released three full length albums since.', 'USA', 1983, 2),
(46, 'Katy Perry', 'Katheryn Elizabeth "Katy" Hudson (born October 25, 1984),[1] better known by her stage name Katy Perry, is an American singer, songwriter, businesswoman, philanthropist, and actress. She was born and raised in Santa Barbara, California. Having had very little exposure to mainstream pop music in her childhood, she pursued a career in gospel music as a teen and released her debut studio album, Katy Hudson, in March 2001. She also recorded a collaborative album with The Matrix and a solo album she worked on with Glen Ballard, the latter of which was never released.', 'United States', 2001, 3),
(47, 'Missy Elliot', 'Melissa Arnette "Missy" Elliott (born July 1, 1971) is an American rapper, singer-songwriter, and record producer. Her first major success came as a songwriter with childhood friend and producer Timbaland on projects for Aaliyah, Total, SWV, and 702. As a record producer and songwriter, she has worked with the likes of Mariah Carey, Whitney Houston, and Janet Jackson, as well as contemporary artists Keyshia Cole, Ciara, and Monica.\nIn the late 1990s, Elliott expanded her a career as a solo artist and female rapper, eventually winning five Grammy Awards and selling over 30 million records in the United States.[1] Elliott is the only female rapper to have six albums certified platinum by the RIAA, including one double platinum for her 2002 album Under Construction.[2]', 'United States', 1997, 4),
(49, 'Yelawolf', 'Yelawolf was born in Gadsden, Alabama but was frequently moving. His mother was only 15 when she gave birth to him. He is of Cherokee and White American descent.[7] Yelawolf claims his mother was a "rockstar" who was constantly partying and under the influence of cocaine. Nashville, Tennessee was a big area of influence for Yelawolf because his mother would travel out there. Specifically, he spent much of his time in Antioch, Tennessee at Hickory Park Place off of Bell Rd. Atha attended Carter Lawrence school in Nashville, Tennessee in which was surrounded by the projects. Yelawolf explains that "This is where Hip-Hop started making sense to him. That''s where Hip-Hop made sense culturally."[8]Hip Hop Sensation', 'USA', 2006, 4),
(50, 'Justin Timberlake', 'Justin Randall Timberlake (born January 31, 1981) is an American singer-songwriter, dancer, businessman, and actor. Born in Memphis, Tennessee, he appeared on the television shows Star Search and The New Mickey Mouse Club as a child. In the late 1990s, Timberlake rose to prominence as the lead singer and youngest member of the boy band ''N Sync, whose launch was financed by Lou Pearlman.', 'United States', 2004, 6),
(52, 'AC/DC', 'AC/DC''s mammoth power chord roar became one of the most influential hard rock sounds of the ''70s. In its own way, it was a reaction against the pompous art rock and lumbering arena rock of the early ''70s. AC/DC''s rock was minimalist — no matter how huge and bludgeoning their guitar chords were, there was a clear sense of space and restraint. Combined with Bon Scott''s larynx-shredding vocals, the band spawned countless imitators over the next two decades and enjoyed commercial success well into the 2000s.\nAC/DC were formed in 1973 in Australia by guitarist Malcolm Young after his previous band, the Velvet Underground, collapsed (Young''s band has no relation to the seminal American group).', 'Australia', 1973, 5);

CREATE TABLE IF NOT EXISTS `artist_album` (
  `album_id` int(11) unsigned NOT NULL,
  `artist_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`album_id`,`artist_id`),
  KEY `FK_artist_album` (`artist_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `artist_album` (`album_id`, `artist_id`) VALUES
(1, 44),
(2, 44),
(87, 44),
(88, 44),
(89, 44),
(90, 44),
(91, 44),
(92, 44),
(93, 44),
(94, 44),
(95, 44),
(96, 44),
(53, 45),
(101, 45),
(102, 45),
(103, 45),
(104, 45),
(105, 45),
(106, 46),
(107, 46),
(108, 46),
(109, 46),
(114, 47),
(115, 47),
(116, 47),
(117, 47),
(118, 47),
(119, 47),
(120, 47),
(3, 49),
(97, 49),
(98, 49),
(99, 49),
(100, 49),
(110, 50),
(111, 50),
(112, 50),
(113, 50),
(29, 52),
(34, 52),
(73, 52),
(74, 52),
(75, 52),
(76, 52),
(77, 52),
(78, 52),
(79, 52),
(80, 52),
(81, 52),
(82, 52),
(83, 52),
(84, 52),
(85, 52),
(86, 52);


CREATE TABLE IF NOT EXISTS `genre` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `description` varchar(128) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;


INSERT INTO `genre` (`id`, `name`, `description`) VALUES
(1, 'Heavy Metal', ''),
(2, 'Thrash', NULL),
(3, 'Pop', NULL),
(4, 'Hip Hop', NULL),
(5, 'Hard Rock', NULL),
(6, 'RNB', NULL),
(7, 'Soundtrack', NULL),
(8, 'Rock', NULL),
(9, 'Country', NULL),
(10, 'Chill Out', NULL);

CREATE TABLE IF NOT EXISTS `track` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `album_id` int(11) unsigned DEFAULT NULL,
  `name` varchar(128) DEFAULT NULL,
  `artist_override` varchar(45) DEFAULT NULL,
  `playtime` varchar(45) DEFAULT NULL,
  `lyrics` varchar(512) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_album_idx` (`album_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=93 ;

INSERT INTO `track` (`id`, `album_id`, `name`, `artist_override`, `playtime`, `lyrics`) VALUES
(23, 1, 'Out From the Asylum', NULL, '1:44', NULL),
(24, 1, 'The Invisible Guests', NULL, '5:04', NULL),
(25, 1, 'Tea', NULL, '5:15', NULL),
(26, 1, 'Mother''s Getting Weaker', NULL, '4:02', NULL),
(27, 1, 'Bye, Bye Missy', NULL, '5:08', NULL),
(28, 1, 'A Broken Spel', NULL, '4:08', NULL),
(29, 1, 'The Accusation Chair', NULL, '4:21', NULL),
(30, 1, 'Them', NULL, '1:56', NULL),
(31, 1, 'Twilight Symphony', NULL, '4:10', NULL),
(32, 1, 'Coming Home', NULL, '1:11', NULL),
(33, 1, 'Welcome Home', NULL, '4:36', NULL),
(34, 2, 'Funeral', NULL, '1:30', NULL),
(35, 2, 'Arrival', NULL, '5:26', NULL),
(36, 2, 'A Mansion in Darkness', NULL, '04:34', NULL),
(37, 2, 'The Family Ghost', NULL, '4:06', NULL),
(38, 2, 'The 7th Day of July 1777', NULL, '4:50', NULL),
(39, 2, 'Omens', NULL, '3:56', NULL),
(40, 2, 'The Possession', NULL, '3:26', NULL),
(41, 2, 'Abigai', NULL, '4:50', NULL),
(42, 2, 'Black Horsemen', NULL, '7:40', NULL),
(43, 3, 'Firestarter', NULL, '4:01', NULL),
(44, 3, 'Way Out', NULL, '4:02', NULL),
(45, 3, 'F.A.S.T. Ride', NULL, '5:08', NULL),
(46, 3, 'Box Chevy (Part 4)', NULL, '03:56', NULL),
(47, 3, 'Hustle', NULL, '3:51', NULL),
(48, 3, 'Catfish Billy', NULL, '4:22', NULL),
(49, 3, 'Gangsta', NULL, '4:49', NULL),
(50, 3, 'Rhyme Room', NULL, '4:13', NULL),
(51, 3, 'Fame', NULL, '03:45', NULL),
(52, 3, 'Tennessee Love', NULL, '4:57', NULL),
(73, 29, 'Hells Bells', NULL, '05:10', 'I''m rolling thunder, pouring rain I''m coming on like a hurricane \nMy lightning''s flashing across the sky You''re only young but you''re gonna die I won''t take no prisoners won''t spare no lives Nobody''s putting up a fight I got my bell I''m gonna take you to hell I''m gonna get ya, satan get ya I''ll give you black sensations up and down your spine'),
(74, 29, 'Shoot to Thrill', NULL, '05:17', 'All you women who want a man of the street\nBut you don''t know which way you wanna turn\nJust keep a coming and put your hand out to me\n''Cause I''m the one who''s gonna make you burn\nI''m gonna take you down - down, down, down\nSo don''t you fool around\nI''m gonna pull it, pull it, pull the trigger\nShoot to thrill, play to kill \nToo many women with too many pills\nShoot to thrill, play to kill\nI got my gun at the ready, gonna fire at will\nYeah'),
(75, 29, 'What Do You Do for Money Honey', NULL, '03:33', 'You''re working in bars\nRiding in cars\nNever gonna give it for free\nYour apartment with a view\nOn the finest avenue\nLooking at your beat on the street\nYou''re always pushing, shoving\nSatisfied with nothing\nYou bitch, you must be getting old\nSo stop your love on the road\nAll your digging for gold\nYou make me wonder\nYes I wonder, I wonder\nHoney, whaddya do for money?'),
(76, 29, 'Given the Dog a Bone', NULL, '03:30', 'She take you down easy\nGoing down to her knees\nGoing down to the devil\nDown down at ninety degrees\nShe blowing me crazy\n''til my ammunition is dry\nShe''s using her head again\nShe''s using her head\nShe''s using her head again\nI''m justa giving the dog a bone\nGiving the dog a bone, giving the dog a bone\nGiving the dog a bone, giving the dog a bone\n\nShe''s no Mona Lisa\nNo she''s no playboy star\nBut she''ll send you to heaven\nThen explode you to Mars\nShe''s using her head again'),
(77, 29, 'Let Me Put My Love Into You', NULL, '04:16', 'Flying on a free flight\nDriving all night\nWith my machinery\n''Cause I, I got the power\nAny hour\nTo show the man in me\nI got reputations\nBlown to pieces\nWith my artillery\nWhoa ho \nI''ll be guided in\nWe''ll be ridin''\nGiven what you got to me\nDon''t you struggle\nDon''t you fight\nDon''t you worry\n''Cause it''s your turn tonight\nCHORUS:\nLet me put my love into you, babe\nLet me put my love on the line\nLet me put my love into you, babe\nLet me cut your cake with my knife'),
(78, 29, 'Back in Black', NULL, '04:14', 'Back in black \nI hit the sack \nI''ve been too long I''m glad to be back \nYes I''m, let loose \nFrom the noose \nThat''s kept me hanging about \nI keep looking at the sky \n''Cause it''s gettin'' me high \nForget the herse ''cause I''ll never die \nI got nine lives \nCat''s eyes \nUsin'' every one of them and running wild \n\n''Cause I''m back \nYes, I''m back \nWell, I''m back \nYes, I''m back \nWell, I''m back, back \n(Well) I''m back in black \nYes, I''m back in black'),
(79, 29, 'You Shook Me All Night Long', NULL, '03:30', 'She was a fast machine \nShe kept her motor clean \nShe was the best damn woman I had ever seen \n[... that I, ever seen] \n\nShe had the sightless eyes \nTelling me no lies \nKnockin'' me out with those American thighs \nTaking more than her share \nHad me fighting for air \nShe told me to come but I was already there \n''Cause the walls start shaking \nThe earth was quaking \nMy mind was aching \nAnd we were making it and you - \n\nCHORUS: \n\nShook me all night long \nYeah you shook me all night long'),
(80, 29, 'Have a Drink on Me', NULL, '03:57', 'Whiskey, gin and brandy\nWith a glass I''m pretty handy\nI''m trying to walk a straight line\nOn sour mash and cheap wine\nSo join me for a drink boys\nWe''re gonna make a big noise\nSo don''t worry about tomorrow\nTake it today\nForget about the cheque\nWe''ll get hell to pay\nHave a drink on me\nHave a drink on me\nYeah\nHave a drink on me\nHave a drink on me\nOn me\nCome on'),
(81, 29, 'Shake a Leg', NULL, '04:06', 'Idle juvenile on the street, on the street\nWho is kicking everything with his feet, with his feet\nFighting on the wrong side of the law, of the law \nDon''t kick, don''t fight, don''t sleep at night\nIt''s shake a leg, shake a leg, shake a leg, shake it yeah\nKeeping out of trouble with eyes in the back of my face\nKicking ass in the class and they tell me you''re a damn disgrace\nThey tell me what they think but they stink and I really don''t care\nGot a mind of my own, move on, get out of my hair'),
(82, 29, 'Rock and Roll Ain''t Noise Pollution', NULL, '04:15', 'Hey there all you middle men \nThrow away your fancy clothes \nAnd while you''re out sittin'' on a fence \nSo get off your arse and come down here \nCause rock ''n'' roll ain''t no riddle man \nTo me it makes good good sense \nGood sense yeah let''s go \n\nHeavy decibels are playing on my guitar \nWe got vibrations comin'' up from the floor \nWe''re just listenin'' to the rock \nThat''s givin'' too much noise \nAre you deaf you wanna hear some more \nWe''re just talking about the future'),
(83, 34, 'For Those About to Rock (We Salute You)', NULL, '05:44', NULL),
(84, 34, 'Put the Finger on You', NULL, '03:25', NULL),
(85, 34, 'Let''s Get It Up', NULL, '03:54', NULL),
(86, 34, 'Inject the Venom', NULL, '03:30', NULL),
(87, 34, 'Snowballed', NULL, '03:23', NULL),
(88, 34, 'Evil Walks', NULL, '04:23', NULL),
(89, 34, 'C.O.D.', NULL, '03:19', NULL),
(90, 34, 'Breaking the Rules', NULL, '04:23', NULL),
(91, 34, 'Night of the Long Knives', NULL, '03:25', NULL),
(92, 34, 'Spellbound', NULL, '04:30', NULL);

ALTER TABLE `album`
  ADD CONSTRAINT `album_ibfk_1` FOREIGN KEY (`genre_id`) REFERENCES `genre` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

ALTER TABLE `artist`
  ADD CONSTRAINT `artist_ibfk_1` FOREIGN KEY (`genre_id`) REFERENCES `genre` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;


ALTER TABLE `artist_album`
  ADD CONSTRAINT `artist_album_ibfk_1` FOREIGN KEY (`artist_id`) REFERENCES `artist` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `artist_album_ibfk_2` FOREIGN KEY (`album_id`) REFERENCES `album` (`id`) ON DELETE CASCADE;

ALTER TABLE `track`
  ADD CONSTRAINT `track_ibfk_1` FOREIGN KEY (`album_id`) REFERENCES `album` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;


      		 ");

	}

	public function down()
	{
        $this->dropTable(`genre`);
        $this->dropTable(`tracks`);
        $this->dropTable(`albums`);
        $this->dropTable(`artist`);
        $this->dropTable(`artist_album`);


//		echo "m131217_123045_music_db does not support migration down.\n";
//		return false;
	}

	/*
	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
	}

	public function safeDown()
	{
	}
	*/
}