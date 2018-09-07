rem 	Assignment 2
rem 	Created: Tommy Nelson / 05-MAR-2017

rem Amendments History:
rem Amendment: 1   T.Nelson/05-MAR-2017
rem						Completed and tested 1st task
rem Amendment: 2   T.Nelson/06-MAR-2017
rem						Completed and tested 2nd and 3rd task
rem Amendment: 3   T.Nelson/07-MAR-2017
rem						Completed and tested 3rd task
rem **********************************


rem TASK 1.4.1
rem Only displays employees with a first name beginning with 'L' and who were hired after '31-JAN-1999'
rem Displays the first letter of the first name, last name, hire date and salary increased by 11.1% rounded to the nearest whole number for each
rem This is then sorted into an ascending sequence of hire date

SELECT SUBSTR(First_Name,1,1), Last_Name, Hire_Date, round(Salary * 1.111,0)
FROM OEHR_EMPLOYEES
WHERE (SUBSTR(Last_Name,1,1)='L')  AND (Hire_Date>'31-JAN-1999')
ORDER BY Hire_Date ASC
/

rem TASK 1.4.2
rem Displays the name and ID of every country along with the number of locations that each has
rem This is then sorted into a ascending sequence of country name

SELECT OEHR_COUNTRIES.Country_Name, OEHR_COUNTRIES.Country_ID, COUNT(OEHR_LOCATIONS.Country_ID) AS Location_Count
FROM OEHR_COUNTRIES
INNER JOIN OEHR_LOCATIONS ON OEHR_COUNTRIES.Country_ID = OEHR_LOCATIONS.Country_ID
GROUP BY OEHR_COUNTRIES.Country_Name, OEHR_COUNTRIES.Country_ID
ORDER BY OEHR_COUNTRIES.Country_Name ASC
/

rem TASK 1.4.3
rem Only display the staff with the job ID of 'SA_MAN' or 'SA_REP'
rem Displays the department name, with its associated country name and city for each
rem Then ordered by ascending sequence of department name within city within county name 

SELECT OEHR_EMPLOYEES.Job_ID, OEHR_DEPARTMENTS.Department_Name, OEHR_COUNTRIES.Country_Name, OEHR_LOCATIONS.City
FROM OEHR_DEPARTMENTS
INNER JOIN OEHR_LOCATIONS ON OEHR_DEPARTMENTS.Location_ID = OEHR_LOCATIONS.Location_ID
INNER JOIN OEHR_COUNTRIES ON OEHR_LOCATIONS.Country_ID = OEHR_COUNTRIES.Country_ID
INNER JOIN OEHR_EMPLOYEES ON OEHR_DEPARTMENTS.Department_ID = OEHR_EMPLOYEES.Department_ID
WHERE (OEHR_EMPLOYEES.Job_ID = 'SA_MAN') OR (OEHR_EMPLOYEES.Job_ID = 'SA_REP')
ORDER BY OEHR_DEPARTMENTS.Department_Name, OEHR_LOCATIONS.City, OEHR_COUNTRIES.Country_Name ASC
/

rem TASK 1.4.4
rem Only displays the three most recently employed employees
rem Displays the last name and length or emaployment in years rounded down the nearest whole number for each

SELECT Last_Name, FLOOR(MONTHS_BETWEEN(SYSDATE,Hire_Date)/12) AS Years_Employed 
FROM (SELECT * FROM OEHR_EMPLOYEES
ORDER BY Hire_Date DESC)
WHERE ROWNUM <=3
/


