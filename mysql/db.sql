-- tables
-- Table: emails
CREATE TABLE emails (
  id serial NOT NULL,
  email char(255) NULL,
  CONSTRAINT emails_pk PRIMARY KEY (id)
);

-- Table: phones
CREATE TABLE phones (
  id serial NOT NULL,
  phone_number char(50) NULL,
  CONSTRAINT id PRIMARY KEY (id)
);

-- Table: users
CREATE TABLE users (
  id serial NOT NULL,
  first_name char(255) NULL,
  sur_name char(255) NULL,
  CONSTRAINT users_pk PRIMARY KEY (id)
);

-- foreign keys
-- Reference: Table_2_user (table: phones)
ALTER TABLE phones ADD CONSTRAINT Table_2_user FOREIGN KEY Table_2_user (id)
REFERENCES users (id);

-- Reference: Table_3_user (table: emails)
ALTER TABLE emails ADD CONSTRAINT Table_3_user FOREIGN KEY Table_3_user (id)
REFERENCES users (id);

-- End of file.

