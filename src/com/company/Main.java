package com.company;

import java.sql.*;

public class Main {
    static Connection cn;
    public static void main(String[] args) {
        try{
            //establish connection
            Class.forName("com.mysql.cj.jdbc.Driver");
            cn=DriverManager.getConnection(
                    "jdbc:mysql://192.168.1.34/cs353?useUnicode=true&useJDBCCompliantTimezoneShift=true&useLegacyDatetimeCode=false&serverTimezone=Europe/Moscow",
                    "root","Ozge123");

            Statement stmt = cn.createStatement();

            //drop tables if they exist
            stmt.executeUpdate("drop table IF EXISTS offers;");
            stmt.executeUpdate("drop table IF EXISTS notifies;");
            stmt.executeUpdate("drop table IF EXISTS reports;");
            stmt.executeUpdate("drop table IF EXISTS recommends;");
            stmt.executeUpdate("drop table IF EXISTS requests;");
            stmt.executeUpdate("drop table IF EXISTS assigns;");
            stmt.executeUpdate("drop table IF EXISTS works;");
            stmt.executeUpdate("drop table IF EXISTS plays;");
            stmt.executeUpdate("drop table IF EXISTS footballer_report;");
            stmt.executeUpdate("drop table IF EXISTS manages;");
            stmt.executeUpdate("drop table IF EXISTS watches;");
            stmt.executeUpdate("drop table IF EXISTS subscribes;");
            stmt.executeUpdate("drop table IF EXISTS report;");
            stmt.executeUpdate("drop table IF EXISTS notification;");
            stmt.executeUpdate("drop table IF EXISTS footballer_trophy;");
            stmt.executeUpdate("drop table IF EXISTS footballer_positions;");
            stmt.executeUpdate("drop table IF EXISTS footballer;");
            stmt.executeUpdate("drop table IF EXISTS scout_league_exp;");
            stmt.executeUpdate("drop table IF EXISTS scout_position_exp;");
            stmt.executeUpdate("drop table IF EXISTS scout;");
            stmt.executeUpdate("drop table IF EXISTS request_positions;");
            stmt.executeUpdate("drop table IF EXISTS request;");
            stmt.executeUpdate("drop table IF EXISTS club;");
            stmt.executeUpdate("drop table IF EXISTS agency;");
            stmt.executeUpdate("drop table IF EXISTS agent;");
            stmt.executeUpdate("drop table IF EXISTS journalist;");
            stmt.executeUpdate("drop table IF EXISTS user;");

            //create tables
            String user = "CREATE TABLE user (" +
                    "id int NOT NULL UNIQUE AUTO_INCREMENT," +
                    "username varchar(45) NOT NULL," +
                    "password varchar(45) NOT NULL," +
                    "PRIMARY KEY (id)" +
                    ");";

            String journalist = "CREATE TABLE journalist (" +
                    "id INT NOT NULL UNIQUE," +
                    "name VARCHAR(45) NOT NULL," +
                    "PRIMARY KEY (id)," +
                    "FOREIGN KEY (id) REFERENCES  user (id)" +
                    ");";

            String agent = "CREATE TABLE agent (" +
                    "id INT NOT NULL UNIQUE," +
                    "name VARCHAR(45) NOT NULL," +
                    "PRIMARY KEY (id)," +
                    "FOREIGN KEY (id) REFERENCES  user (id)" +
                    ");";

            String agency = "CREATE TABLE agency (" +
                    "id INT NOT NULL UNIQUE," +
                    "name VARCHAR(45) NOT NULL," +
                    "activation_key INT NULL," +
                    "no_of_scouts INT DEFAULT 0," +
                    "PRIMARY KEY (id)," +
                    "FOREIGN KEY (id) REFERENCES  user (id)" +
                    ");";

            String club = "CREATE TABLE club (" +
                    "id int NOT NULL UNIQUE," +
                    "name varchar(45) NOT NULL," +
                    "budget int DEFAULT NULL," +
                    "league varchar(45) NOT NULL," +
                    "city varchar(45) NOT NULL," +
                    "director varchar(45) DEFAULT NULL," +
                    "value int DEFAULT NULL," +
                    "num_of_players int DEFAULT 0," +
                    "PRIMARY KEY (id)," +
                    "FOREIGN KEY (id) REFERENCES  user (id)" +
                    ");";

            String request = "CREATE TABLE request (" +
                    "id int NOT NULL UNIQUE AUTO_INCREMENT, " +
                    "no_of_req_scouts int DEFAULT NULL," +
                    "organization varchar(45) DEFAULT NULL," +
                    "start_date datetime NOT NULL," +
                    "end_date datetime NOT NULL," +
                    "PRIMARY KEY (id)" +
                    ");";

            String request_positions = "CREATE TABLE request_positions (" +
                    "id int NOT NULL," +
                    "position varchar(45) NOT NULL," +
                    "PRIMARY KEY (id, position)," +
                    "FOREIGN KEY (id) REFERENCES request (id)" +
                    ");";

            String scout = "CREATE TABLE scout (" +
                    "id INT NOT NULL UNIQUE," +
                    "name VARCHAR(45) NOT NULL," +
                    "availability TINYINT NOT NULL DEFAULT 1," +
                    "PRIMARY KEY (id)," +
                    "FOREIGN KEY (id) REFERENCES  user (id)" +
                    ");";

            String scout_position_exp = "CREATE TABLE scout_position_exp (" +
                    "id INT NOT NULL," +
                    "position VARCHAR(45) NOT NULL," +
                    "PRIMARY KEY (id, position)," +
                    "FOREIGN KEY (id) REFERENCES scout (id)" +
                    ");";

            String scout_league_exp = "CREATE TABLE scout_league_exp (" +
                    "id INT NOT NULL," +
                    "league VARCHAR(45) NOT NULL," +
                    "PRIMARY KEY (id, league)," +
                    "FOREIGN KEY (id) REFERENCES scout (id)" +
                    ");";

            String footballer = "CREATE TABLE footballer (" +
                    "id INT NOT NULL UNIQUE AUTO_INCREMENT," +
                    "name VARCHAR(45) NOT NULL," +
                    "age INT NULL," +
                    "value DOUBLE NULL," +
                    "nationality VARCHAR(45) NOT NULL," +
                    "PRIMARY KEY (id)" +
                    ");";

            String footballer_positions = "CREATE TABLE footballer_positions (" +
                    "id INT NOT NULL," +
                    "position VARCHAR(45) NOT NULL," +
                    "PRIMARY KEY (id, position)," +
                    "FOREIGN KEY (id) REFERENCES footballer (id)" +
                    ");";

            String footballer_trophy = "CREATE TABLE footballer_trophy (" +
                    "id INT NOT NULL," +
                    "trophy VARCHAR(45) NOT NULL," +
                    "PRIMARY KEY (id, trophy)," +
                    "FOREIGN KEY (id) REFERENCES footballer (id)" +
                    ");";

            String notification = "CREATE TABLE notification (" +
                    "id INT NOT NULL," +
                    "date VARCHAR(15) NULL," +
                    "PRIMARY KEY (id)" +
                    ");";

            String report = "CREATE TABLE report (" +
                    "id INT NOT NULL," +
                    "date VARCHAR(15) NOT NULL," +
                    "rating DOUBLE NULL," +
                    "comment VARCHAR(45) NULL," +
                    "PRIMARY KEY (id)" +
                    ");";

            String subscribes = "CREATE TABLE subscribes (" +
                    "journalist_id INT NOT NULL," +
                    "club_id INT NOT NULL," +
                    "PRIMARY KEY (journalist_id, club_id)," +
                    "FOREIGN KEY (journalist_id) REFERENCES journalist (id)," +
                    "FOREIGN KEY (club_id) REFERENCES club (id)" +
                    ");";

            String watches = "CREATE TABLE watches (" +
                    "scout_id INT NOT NULL," +
                    "footballer_id INT NOT NULL," +
                    "PRIMARY KEY (scout_id, footballer_id)," +
                    "FOREIGN KEY (scout_id) REFERENCES scout (id)," +
                    "FOREIGN KEY (footballer_id) REFERENCES footballer (id)" +
                    ");";

            String manages = "CREATE TABLE manages (" +
                    "footballer_id INT NOT NULL," +
                    "agent_id INT NOT NULL," +
                    "PRIMARY KEY (footballer_id)," +
                    "FOREIGN KEY (footballer_id) REFERENCES footballer (id)," +
                    "FOREIGN KEY (agent_id) REFERENCES agent (id)" +
                    ");";

            String footballer_report = "CREATE TABLE footballer_report (" +
                    "report_id INT NOT NULL," +
                    "footballer_id INT NOT NULL," +
                    "PRIMARY KEY (report_id)," +
                    "FOREIGN KEY (report_id) REFERENCES report (id)," +
                    "FOREIGN KEY (footballer_id) REFERENCES footballer (id)" +
                    ");";

            String plays = "CREATE TABLE plays (" +
                    "footballer_id INT NOT NULL," +
                    "club_id INT NOT NULL," +
                    "salary VARCHAR(15) NULL," +
                    "contract_end VARCHAR(15) NULL," +
                    "PRIMARY KEY (footballer_id)," +
                    "FOREIGN KEY (footballer_id) REFERENCES footballer (id)," +
                    "FOREIGN KEY (club_id) REFERENCES club (id)" +
                    ");";

            String works = "CREATE TABLE works (" +
                    "scout_id INT NOT NULL," +
                    "agency_id INT NOT NULL," +
                    "PRIMARY KEY (scout_id)," +
                    "FOREIGN KEY (scout_id) REFERENCES scout (id)," +
                    "FOREIGN KEY (agency_id) REFERENCES agency (id)" +
                    ");";

            String assigns = "CREATE TABLE assigns (" +
                    "agency_id INT NOT NULL," +
                    "request_id INT NOT NULL," +
                    "scout_id INT NOT NULL," +
                    "PRIMARY KEY (agency_id, request_id, scout_id)," +
                    "FOREIGN KEY (agency_id) REFERENCES agency (id)," +
                    "FOREIGN KEY (request_id) REFERENCES request (id)," +
                    "FOREIGN KEY (scout_id) REFERENCES scout (id)" +
                    ");";

            String requests = "CREATE TABLE requests (" +
                    "request_id int NOT NULL," +
                    "club_id int NOT NULL," +
                    "agency_id int NOT NULL," +
                    "status varchar(10) NOT NULL DEFAULT 'pending'," +
                    "PRIMARY KEY (request_id)," +
                    "FOREIGN KEY (request_id) REFERENCES request (id)," +
                    "FOREIGN KEY (club_id) REFERENCES club (id)," +
                    "FOREIGN KEY (agency_id) REFERENCES agency (id)" +
                    ");";

            String recommends = "CREATE TABLE recommends (" +
                    "agent_id INT NOT NULL," +
                    "club_id INT NOT NULL," +
                    "footballer_id INT NOT NULL," +
                    "comment VARCHAR(45) NULL," +
                    "PRIMARY KEY (agent_id, club_id, footballer_id)," +
                    "FOREIGN KEY (agent_id) REFERENCES agent (id)," +
                    "FOREIGN KEY (club_id) REFERENCES club (id)," +
                    "FOREIGN KEY (footballer_id) REFERENCES footballer (id)" +
                    ");";

            String reports = "CREATE TABLE reports (" +
                    "report_id INT NOT NULL," +
                    "scout_id INT NOT NULL," +
                    "club_id INT NOT NULL," +
                    "PRIMARY KEY (report_id)," +
                    "FOREIGN KEY (report_id) REFERENCES report (id)," +
                    "FOREIGN KEY (scout_id) REFERENCES scout (id)," +
                    "FOREIGN KEY (club_id) REFERENCES club (id)" +
                    ");";

            String notifies = "CREATE TABLE notifies (" +
                    "notification_id INT NOT NULL," +
                    "journalist_id INT NOT NULL," +
                    "request_id INT NOT NULL," +
                    "PRIMARY KEY (notification_id, journalist_id, request_id)," +
                    "FOREIGN KEY (notification_id) REFERENCES notification (id)," +
                    "FOREIGN KEY (journalist_id) REFERENCES journalist (id)," +
                    "FOREIGN KEY (request_id) REFERENCES request (id)" +
                    ");";

            String offers = "CREATE TABLE offers (" +
                    "offerer_id INT NOT NULL," +
                    "offeree_id INT NOT NULL," +
                    "footballer_id INT NOT NULL," +
                    "agent_id INT NOT NULL," +
                    "transfer_offer VARCHAR(15) NOT NULL," +
                    "status VARCHAR(10) NOT NULL DEFAULT 'pending'," +
                    "PRIMARY KEY (offerer_id, offeree_id, footballer_id, agent_id, transfer_offer)," +
                    "FOREIGN KEY (offerer_id) REFERENCES club (id)," +
                    "FOREIGN KEY (offeree_id) REFERENCES club (id)," +
                    "FOREIGN KEY (footballer_id) REFERENCES footballer (id)," +
                    "FOREIGN KEY (agent_id) REFERENCES agent (id)" +
                    ");";

            stmt.executeUpdate(user);
            stmt.executeUpdate(journalist);
            stmt.executeUpdate(agent);
            stmt.executeUpdate(agency);
            stmt.executeUpdate(club);
            stmt.executeUpdate(request);
            stmt.executeUpdate(request_positions);
            stmt.executeUpdate(scout);
            stmt.executeUpdate(scout_position_exp);
            stmt.executeUpdate(scout_league_exp);
            stmt.executeUpdate(footballer);
            stmt.executeUpdate(footballer_positions);
            stmt.executeUpdate(footballer_trophy);
            stmt.executeUpdate(notification);
            stmt.executeUpdate(report);
            stmt.executeUpdate(subscribes);
            stmt.executeUpdate(watches);
            stmt.executeUpdate(manages);
            stmt.executeUpdate(footballer_report);
            stmt.executeUpdate(plays);
            stmt.executeUpdate(works);
            stmt.executeUpdate(assigns);
            stmt.executeUpdate(requests);
            stmt.executeUpdate(recommends);
            stmt.executeUpdate(reports);
            stmt.executeUpdate(notifies);
            stmt.executeUpdate(offers);

        }catch(Exception e){ e.printStackTrace();}
    }
}