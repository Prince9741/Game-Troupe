CREATE TABLE `Game`
(
 `GameId` int NOT NULL AUTO_INCREMENT ,
 `GameName` varchar(30) NOT NULL ,
 `ScoreType` int(1) NOT NULL,

PRIMARY KEY (`GameId`),
UNIQUE KEY `GameInformation` (`GameName`)
) AUTO_INCREMENT=1 COMMENT='Game Details';

CREATE TABLE `Gender`
(
 `GenderId`   int NOT NULL ,
 `GenderType` char NOT NULL ,
PRIMARY KEY (`GenderId`)
) COMMENT='Person Gender details';

CREATE TABLE `Players`
(
 `UserId`   int NOT NULL AUTO_INCREMENT ,
 `UserName` varchar(20) NOT NULL ,
 `GenderId` int NOT NULL ,
 `Password` varchar(20) NOT NULL ,

PRIMARY KEY (`UserId`),
UNIQUE KEY  (`UserName`),
KEY (`GenderId`),
CONSTRAINT `GenderInformation` FOREIGN KEY `Sex` (`GenderId`) REFERENCES `Gender` (`GenderId`)
) AUTO_INCREMENT=1 COMMENT='Players Data stored or login information';

CREATE TABLE `HighScore`
(
 `ScoreId` int NOT NULL AUTO_INCREMENT ,
 `Score`   int NOT NULL ,
 `UserId`  int NOT NULL ,
 `GameId`  int NOT NULL ,
 `Date`    timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,

PRIMARY KEY (`ScoreId`),
KEY (`GameId`),
CONSTRAINT `GameDetail` FOREIGN KEY `GameId` (`GameId`) REFERENCES `Game` (`GameId`),
KEY (`UserId`),
CONSTRAINT `UserDetail` FOREIGN KEY `UserId` (`UserId`) REFERENCES `Players` (`UserId`)
) AUTO_INCREMENT=1 COMMENT='All Game High Scored Stored here';