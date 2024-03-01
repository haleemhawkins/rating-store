-- SQLite



SELECT [Comment].[ProductID], Product.ProductName AS [Product Name], count(*) AS [Total Comments]
FROM Comment JOIN Product ON Comment.ProductID = Product.ProductID
GROUP BY [Comment].ProductID;