CREATE TABLE IF NOT EXISTS messages
(
    id      INTEGER PRIMARY KEY AUTOINCREMENT,
    name    VARCHAR(250) NOT NULL,
    email   VARCHAR(500) NOT NULL,
    message TEXT(5000)   NOT NULL,
    status  INTEGER(1)   NOT NULL DEFAULT 0,
    time    INTEGER(15)  NOT NULL
);

CREATE TABLE IF NOT EXISTS errors
(
    id     INTEGER PRIMARY KEY AUTOINCREMENT,
    file   VARCHAR(1000) NOT NULL,
    status INTEGER(1)    NOT NULL DEFAULT 0
);

CREATE TABLE IF NOT EXISTS notifications
(
    id           INTEGER PRIMARY KEY AUTOINCREMENT,
    notification TEXT       NOT NULL,
    status       INTEGER(1) NOT NULL DEFAULT 1
);

CREATE TABLE IF NOT EXISTS statistics
(
    id         INTEGER PRIMARY KEY AUTOINCREMENT,
    url        TEXT        NOT NULL,
    parameters TEXT        NOT NULL,
    time       INTEGER(30) NOT NULL
);