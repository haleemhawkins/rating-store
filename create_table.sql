-- SQLite

CREATE TABLE [Product] (
    ProductID int,
    ProductName string,
    ProductImg VARBINARY(1000), 
    Tags string
);

CREATE TABLE [User] (
    UserID uint,
    UserName string,
    Password int,
    isAdmin bool
);

CREATE TABLE [Comment] (
    CommentID int,
    Content string,
    ProductID int, 
    UserID int
);