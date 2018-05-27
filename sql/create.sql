DROP DATABASE IF EXISTS CS143;
CREATE DATABASE CS143;
USE CS143;

CREATE TABLE Movie( 
	id INT NOT NULL,
	title VARCHAR(100) NOT NULL,
	year INT NOT NULL,
	rating VARCHAR(10),
	company VARCHAR(50),
	PRIMARY KEY(id), -- Primary key set to be ID.
	CHECK (year > 0 AND year < 3000)) ENGINE = INNODB; -- This constraint checks to make sure the year is a realistic number. 

CREATE TABLE Actor(
	id INT NOT NULL,
	last VARCHAR(20) NOT NULL,
	first VARCHAR(20) NOT NULL,
	sex VARCHAR(6) NOT NULL,
	dob DATE NOT NULL,
	dod DATE,
	PRIMARY KEY(id), -- Primary key set to be ID.
	CHECK (sex = 'Male' OR sex = 'Female')) ENGINE = INNODB; -- Sex cannot be anything other the Male or Female

CREATE TABLE Director(
	id INT NOT NULL,
	last VARCHAR(20) NOT NULL,
	first VARCHAR(20) NOT NULL,
	dob DATE NOT NULL,
	dod DATE,
	PRIMARY KEY(id)) ENGINE = INNODB; -- Primary key set to be ID.
 
CREATE TABLE MovieGenre(
	mid INT NOT NULL,
	genre VARCHAR(20) NOT NULL,
	PRIMARY KEY(mid, genre), -- Primary key set to be mid, genre pair
	FOREIGN KEY(mid) REFERENCES Movie(id)) ENGINE = INNODB; -- Foreign key is also mid since there must be a corresponding id in the Movie relation.

CREATE TABLE MovieDirector(
	mid INT NOT NULL,
	did INT NOT NULL,
	PRIMARY KEY(mid, did), -- Primary key set to be the mid, did pair (since there may be multiple mids and dids in the relation).
	FOREIGN KEY(mid) REFERENCES Movie(id), -- References id from Movie, there cannot be a mid that doesn't correspond to an id from Movie.
	FOREIGN KEY(did) REFERENCES Director(id)) ENGINE = INNODB; -- References id from Director, there cannot be a did that doesn't correspond to an id from Director.

CREATE TABLE MovieActor(
	mid INT NOT NULL, 
	aid INT NOT NULL,
	role VARCHAR(50),
	PRIMARY KEY(mid, aid),  -- Primary key set to be mid, aid pair.
	FOREIGN KEY(mid) REFERENCES Movie(id), -- References id from Movie, there cannot be a mid that doesn't correspond to an id from Movie
	FOREIGN KEY(aid) REFERENCES Actor(id)) ENGINE = INNODB; -- References id from Actor, there cannot be a aid that doesn't correspond to an id from Actor.

CREATE TABLE Review(
	name VARCHAR(20) NOT NULL,
	time TIMESTAMP NOT NULL,
	mid INT NOT NULL,
	rating INT NOT NULL,
	comment VARCHAR(500),
	FOREIGN KEY(mid) REFERENCES Movie(id), -- Foreign key mid should reference id from Movie since there cannot be a mid without a corresponding Movie id.
	CHECK (rating BETWEEN 0 AND 10)) ENGINE = INNODB; -- The rating must be between 0 and 10 inclusive. 

CREATE TABLE MaxPersonID(
	id INT NOT NULL
) ENGINE = INNODB;

CREATE TABLE MaxMovieID(
	id INT NOT NULL
) ENGINE = INNODB;

