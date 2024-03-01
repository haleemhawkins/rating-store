-- SQLite



SELECT [Comment].UserID, [User].[UserName], count(*) AS [Total Comments]
FROM Comment JOIN User ON Comment.UserID = User.UserID
GROUP BY [Comment].UserID;