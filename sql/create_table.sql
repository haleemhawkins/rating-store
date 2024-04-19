-- SQLite

CREATE TABLE [Product] (
    ProductID int,
    ProductName string,
    ProductImg VARBINARY(1000), 
    Tags string,
    Stock int(255),
    Price Decimal(10,2) CHECK (Price > 0)
);

CREATE TABLE [User] (
    UserID uint,
    UserName string,
    Password int,
    isAdmin bool
);

CREATE TABLE [SentimentDatabase] (
    Keyword string,
    Weight int
);

CREATE TABLE [Comment] (
    CommentID INTEGER PRIMARY KEY AUTOINCREMENT,
    Content TEXT,
    ProductID INTEGER,
    UserID INTEGER
);

