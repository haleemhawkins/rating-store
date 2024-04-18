-- SQLite

CREATE TABLE [Product] (
    ProductID int,
    ProductName string,
    ProductImg VARBINARY(1000), 
    Tags string,
    Stock int(255),
    Price Decimal(10,2) CHECK (Price > 0)
    Rating CHECK 
        (Rating IN ('A+', 'A', 'A-',
         'B+', 'B', 'B-', 'C+', 'C',
         'C-', 'D+', 'D', 'D-', 'F')) 
);


CREATE TABLE [SentimentDatabase] (
    Keyword string,
    Weight int
);

CREATE TABLE [Comment] (
    CommentID INTEGER PRIMARY KEY AUTOINCREMENT,
    Content TEXT,
    ProductID INTEGER,
    UserID INTEGER,
    SentimentScore int
);

