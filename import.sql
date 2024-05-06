
CREATE DATABASE parking_management;

CREATE TABLE vehicle_category(
    id SERIAL PRIMARY KEY,
    name varchar(60) NOT NULL,
    rate DECIMAL(10,2) NOT NULL
);

CREATE TABLE vehicles(
    id SERIAL PRIMARY KEY,
    plate VARCHAR(7) NOT NULL,
    id_vehicle_category INTEGER NOT NULL,
    FOREIGN KEY (id_vehicle_category) REFERENCES vehicle_category (id)
);

CREATE TABLE entries(
    id SERIAL PRIMARY KEY,
    date_entry TIMESTAMP NOT NULL,
    active BOOLEAN DEFAULT false,
    id_vehicle INTEGER NOT NULL,
    FOREIGN KEY (id_vehicle) REFERENCES vehicles (id)
);

CREATE TABLE exits(
    id SERIAL PRIMARY KEY,
    date_exit TIMESTAMP NOT NULL,
    id_vehicle INTEGER NOT NULL,
    FOREIGN KEY (id_vehicle) REFERENCES vehicles (id)
);