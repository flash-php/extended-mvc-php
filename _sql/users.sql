CREATE TABLE users (
	id SERIAL PRIMARY KEY,
	firstname VARCHAR(64),
	lastname VARCHAR(64),
	email VARCHAR(64),
	password VARCHAR(64)
);

SELECT * FROM users;

DROP TABLE users;