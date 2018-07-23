<?

$db=sqlite_open("tables.db");

//put usernames and passwords into same table
sqlite_query($db, "DROP TABLE logins");
//only 10 characters for username and password
sqlite_query($db,"CREATE TABLE logins (userID integer PRIMARY KEY, username varchar(10), password varchar(10))",$sqliteerror);

//add intial values to logins
sqlite_query($db,'INSERT INTO logins VALUES ( 1,"admin", "0000")');
sqlite_query($db,'INSERT INTO logins VALUES ( 2,"user1", "1111")');
sqlite_query($db,'INSERT INTO logins VALUES ( 3,"user2", "2222")');
sqlite_query($db,'INSERT INTO logins VALUES ( 4,"user3", "3333")');

//table of topics
sqlite_query($db, "DROP TABLE topics");
sqlite_query($db,"CREATE TABLE topics (topicID integer PRIMARY KEY, username varchar(10), topic varchar(40), totalRating number)",$sqliteerror);


//table with comments no entries to start
sqlite_query($db, "DROP TABLE comments");
sqlite_query($db,"CREATE TABLE comments (commentID integer PRIMARY KEY, username varchar(10),topic varchar(40), comment varchar(50), commentDate date, commentTime time, rating number)",$sqliteerror);


//table containing keywords and ratings
sqlite_query($db, "DROP TABLE keywords");
sqlite_query($db,"CREATE TABLE keywords (keywordID integer PRIMARY KEY, keyword varchar(10), ratingValue integer)",$sqliteerror);
sqlite_query($db,'INSERT INTO keywords VALUES ( 1,"rubbish", -5)');
sqlite_query($db,'INSERT INTO keywords VALUES ( 2,"worst", -3)');
sqlite_query($db,'INSERT INTO keywords VALUES ( 3,"bad", -1)');
sqlite_query($db,'INSERT INTO keywords VALUES ( 4,"ok", 1)');
sqlite_query($db,'INSERT INTO keywords VALUES ( 5,"good", 3)');
sqlite_query($db,'INSERT INTO keywords VALUES ( 6,"better", 5)');
sqlite_query($db,'INSERT INTO keywords VALUES ( 7,"excellent", 7)');
sqlite_close($db);

?>
