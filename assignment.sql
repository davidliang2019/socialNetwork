CREATE TABLE Users(
	userId int not null auto_increment,
	firstName varchar(255) not null,
	lastName varchar(255) not null,
	dateOfBirth char(10) not null,
	email varchar(255) not null,
	password varchar(100) not null,
	PRIMARY KEY (userId)
);

CREATE TABLE Status(
	statusId int not null auto_increment,
	userId int not null,
	image varchar(255),
	content varchar(255),
	title varchar(255),
	date varchar(255),
	PRIMARY KEY (statusId),
	FOREIGN KEY (userId) REFERENCES Users (userId)
);

CREATE TABLE Comments(
	commentId int not null auto_increment,
	statusId int not null,
	userId int not null,
	image varchar(255),
	content varchar(255),
	date varchar(255),
	PRIMARY KEY (commentId),
	FOREIGN KEY (userId) REFERENCES Users (userId),
	FOREIGN KEY (statusId) REFERENCES Status (statusId)
);

CREATE TABLE Status_like(
	statusId int not null,
	userId int not null,
	FOREIGN KEY (userId) REFERENCES Users (userId),
	FOREIGN KEY (statusId) REFERENCES Status (statusId)
);

CREATE TABLE Comment_like(
	commentId int not null,
	userId int not null,
	FOREIGN KEY (userId) REFERENCES Users (userId),
	FOREIGN KEY (commentId) REFERENCES Comments (commentId)
);
