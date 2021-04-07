CREATE DATABASE `ejemplosimf` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;

-- ejemplosimf.Book definition

CREATE TABLE `Book` (
  `Id` int NOT NULL AUTO_INCREMENT,
  `Title` varchar(250) NOT NULL,
  `Author` varchar(250) NOT NULL,
  `YearPublication` int DEFAULT NULL,
  `TotalPages` int DEFAULT NULL,
  `Price` float NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


-- ejemplosimf.Chapter definition

CREATE TABLE `Chapter` (
  `Name` varchar(250) NOT NULL,
  `ChapterNumber` int NOT NULL,
  `BookId` int NOT NULL,
  PRIMARY KEY (`BookId`,`ChapterNumber`),
  CONSTRAINT `Chapter_FK` FOREIGN KEY (`BookId`) REFERENCES `Book` (`Id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
