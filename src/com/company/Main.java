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

        }catch(Exception e){ e.printStackTrace();}
    }
}