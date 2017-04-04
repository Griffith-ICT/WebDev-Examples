/* Sample tables and data for stock database example using SQLite. */

CREATE TABLE IF NOT EXISTS Stock (
	Id INTEGER PRIMARY KEY,
	Name VARCHAR(20) DEFAULT '' NOT NULL UNIQUE,
	Quantity INT DEFAULT '0' NOT NULL,
	Price DECIMAL(8,2) NOT NULL,
	Description TEXT);

CREATE TABLE IF NOT EXISTS Customers (
	Id INTEGER PRIMARY KEY,
	Name VARCHAR(20) default '' NOT NULL,
	Address VARCHAR(80),
	Email VARCHAR(30));
	
CREATE TABLE IF NOT EXISTS Orders (
	Id INTEGER PRIMARY KEY,
	ItemId INTEGER NOT NULL REFERENCES Stock(Id),
	CustId INTEGER NOT NULL REFERENCES Customers(Id),
	OrderDate DATE,
	Quantity INT DEFAULT '0');
	
INSERT INTO Stock(Name, Quantity, Price, Description)
	VALUES 
	("Marcel's Morsels", 1500, 1.25, "Delectable delicious delicacies");
INSERT INTO Stock(Name, Quantity, Price, Description)
	VALUES 
	("Fred's Fries", 1000, 0.75, "Fabulous french fries");
INSERT INTO Stock(Name, Quantity, Price, Description)
	VALUES 
	("Craig's Cabbages", 500, 15.00, "Cool & crazy cabbages");

INSERT INTO Customers(Name, Address, Email)
	VALUES 
	("Bob", "123 Fake St, Logan", "bob@someisp.com");
INSERT INTO Customers(Name, Address, Email)
	VALUES 
	("Sally", "1000 Fun St, Nathan", "sally@gmail.com");
INSERT INTO Customers(Name, Address, Email)
	VALUES 
	("John", "700 Friendly St, Woodridge", "john@anotherisp.com");

INSERT INTO Orders(ItemId, CustId, OrderDate, Quantity)
	VALUES 
	(1, 1, "2006-03-22", 10);
INSERT INTO Orders(ItemId, CustId, OrderDate, Quantity)
	VALUES 
	(1, 3, "2006-03-23", 20);
INSERT INTO Orders(ItemId, CustId, OrderDate, Quantity)
	VALUES 
	(2, 2, "2006-03-24", 30);
INSERT INTO Orders(ItemId, CustId, OrderDate, Quantity)
	VALUES 
	(2, 3, "2006-03-24", 40);

/* 
 * The statements inserting rows into table Orders are very bad style.
 * They assume you know the ItemId and CustId of each order.
 * But, in practice, these would only be known to some program
 * that had retrieved them by a search on ItemName or CustName,
 * or by following some reference to them.
 *
 * So better style wold be to execute a sequence of insertions
 * such as this:

INSERT INTO Orders(ItemId, CustId, OrderDate, Quantity)
	SELECT item.Id, cust.Id, "2006-03-26", 100
	FROM Stock item, Customers cust
	WHERE item.Name = "Marcel's Morsels"
	AND cust.Name = "Bob";

 * Note that this statement could add more than one order if there 
 * were more than one customer named "Bob" (which is possible with
 * this schema).
 */ 