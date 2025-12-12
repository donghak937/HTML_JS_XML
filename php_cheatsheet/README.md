# PHP + MySQL + SQL 올인원 치트시트

## 0. 환경 셋업

1. XAMPP 설치
2. **Apache**, **MySQL** Start 버튼으로 실행
3. 프로젝트 폴더 만들기  
   - `C:\xampp\htdocs\php_cheatsheet\`
4. 이 폴더 안에:
   - `hello.php`
   - `hello_css.php`
   - `form_get.html`
   - `welcome_get.php`
   - `form_post.html`
   - `welcome_post.php`
   - `form_db.html`
   - `welcome_db.php`
   - `list_db.php`
   - `README.md` (지금 이 파일)

브라우저에서 접속 예시:

- `http://localhost/php_cheatsheet/hello.php`
- `http://localhost/php_cheatsheet/form_get.html`
- ...

---

## 1. PHP 기본 문법

### 1-1. PHP 태그

```php
<?php
    // PHP 코드는 이 안에
    echo "Hello World!";
?>
```

HTML 안에서 섞어서 사용:

```php
<h1>Title</h1>
<?php echo "Content"; ?>
```

### 1-2. `echo` 로 출력

```php
echo "문자열";
echo 123;
echo "<h2>Hello</h2>";
```

### 1-3. 대소문자 규칙

* **키워드/함수**는 대소문자 구분 안 함

  * `echo`, `ECHO`, `EcHo` 모두 가능
* **변수 이름**은 대소문자 구분 **함**

  * `$age` 와 `$AGE` 는 다른 변수

### 1-4. 변수

규칙:

* `$` 로 시작 (`$name`, `$x`)
* 첫 글자는 영문자 또는 `_`
* 숫자로 시작 불가
* 영문자 + 숫자 + `_` 만 가능
* 변수 이름은 대소문자 구분

예:

```php
$txt = "Hello world!";
$x   = 5;
$y   = 10.5;

echo $txt;  // Hello world!
echo "<br>";
echo $x;    // 5
echo "<br>";
echo $y;    // 10.5
```

문자열 연결:

```php
$txt = "W3Schools.com";
echo "I love $txt!";
echo "I love " . $txt . "!";
```

### 1-5. 주석

```php
// 한 줄 주석
# 이것도 한 줄 주석

/*
여러 줄
주석
*/
```

코드 일부 비활성화:

```php
$x = 5 /* + 15 */ + 5;  // 결과 10
```

---

## 2. HTML 폼 + PHP (GET / POST)

### 2-1. GET 방식

* URL 에 값이 보임
* 예) `...?name=Eugene&email=eugene@handong.edu`

1. `form_get.html`:

```html
<form action="welcome_get.php" method="get">
  Name: <input type="text" name="name"><br>
  E-mail: <input type="text" name="email"><br>
  <input type="submit">
</form>
```

2. `welcome_get.php`:

```php
$name  = $_GET["name"];
$email = $_GET["email"];
```

### 2-2. POST 방식

* URL 에 값이 **안 보임**
* 로그인/회원가입 등 민감한 데이터에 사용

1. `form_post.html`:

```html
<form action="welcome.php" method="post">
  ...
</form>
```

2. `welcome_post.php`:

```php
$name  = $_POST["name"];
$email = $_POST["email"];
```

---

## 3. PHP + MySQL 연동

### 3-1. DB와 테이블 만들기 (phpMyAdmin)

1. 브라우저에서 `http://localhost/phpmyadmin` 접속
2. SQL 탭에서 실행:

```sql
CREATE DATABASE IF NOT EXISTS testdb
  CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;

USE testdb;

CREATE TABLE IF NOT EXISTS exercise_sql (
    name  VARCHAR(20) NOT NULL,
    email VARCHAR(30) NOT NULL
);
```

### 3-2. INSERT 흐름

1. HTML 폼: `form_db.html`
2. 폼 제출 → `welcome_db.php` 로 `POST`
3. PHP 가 MySQL에 접속해서 INSERT 실행
4. 성공/실패 메시지 출력

핵심 코드 (welcome_db.php):

```php
$conn = new mysqli("localhost", "root", "", "testdb");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$conn->set_charset("utf8mb4");

$name  = $_POST["name"];
$email = $_POST["email"];

$sql = "INSERT INTO exercise_sql (name, email)
        VALUES ('" . $conn->real_escape_string($name) . "',
                '" . $conn->real_escape_string($email) . "')";

if ($conn->query($sql) === TRUE) {
    echo "A record for name and email has been inserted.";
} else {
    echo "Could not insert record: " . $conn->error;
}

$conn->close();
```

### 3-3. SELECT 흐름

1. 브라우저에서 `list_db.php` 요청
2. `SELECT name, email FROM exercise_sql`
3. 결과를 `while` 루프로 돌면서 출력

중요 부분:

```php
$sql    = "SELECT name, email FROM exercise_sql";
$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo $row["name"] . " - " . $row["email"] . "<br>";
    }
} else {
    echo "0 results";
}
```

---

## 4. SQL 치트시트

### 4-1. 기본 SELECT

```sql
SELECT column1, column2
FROM table_name;
```

모든 컬럼:

```sql
SELECT * FROM Customers;
```

조건:

```sql
SELECT * FROM Customers
WHERE Country = 'Mexico';
```

### 4-2. 비교 & 논리 연산

* 비교: `=`, `<>`, `>`, `<`, `>=`, `<=`
* 논리: `AND`, `OR`, `NOT`

```sql
WHERE Country='Germany' AND City='Berlin';
```

### 4-3. 정렬 ORDER BY

```sql
ORDER BY City ASC;
ORDER BY City DESC;
```

### 4-4. NULL

```sql
WHERE Address IS NULL;
WHERE Address IS NOT NULL;
```

### 4-5. LIKE / 와일드카드

* `%` : 0글자 이상
* `_` : 정확히 1글자

```sql
WHERE CustomerName LIKE 'A%';   -- A로 시작
WHERE CustomerName LIKE '%co';  -- co로 끝
WHERE CustomerName LIKE '_r%';  -- 두 번째 글자가 r
```

### 4-6. INSERT / UPDATE / DELETE

```sql
INSERT INTO Customers (CustomerName, City, Country)
VALUES ('Eugene', 'Seoul', 'Korea');

UPDATE Customers
SET ContactName='Alfred Schmidt', City='Frankfurt'
WHERE CustomerID=1;

DELETE FROM Customers
WHERE CustomerName='Alfreds Futterkiste';
```

### 4-7. JOIN 요약

```sql
-- INNER JOIN: 양쪽에 다 있는 것만
SELECT O.OrderID, C.CustomerName
FROM Orders O
INNER JOIN Customers C
  ON O.CustomerID = C.CustomerID;

-- LEFT JOIN: 왼쪽은 모두, 오른쪽 없으면 NULL
SELECT C.CustomerName, O.OrderID
FROM Customers C
LEFT JOIN Orders O
  ON C.CustomerID = O.CustomerID;

-- RIGHT JOIN: 오른쪽은 모두, 왼쪽 없으면 NULL
SELECT O.OrderID, C.CustomerName
FROM Orders O
RIGHT JOIN Customers C
  ON O.CustomerID = C.CustomerID;

-- FULL OUTER JOIN (MySQL 흉내: LEFT + RIGHT UNION)
SELECT C.CustomerName, O.OrderID
FROM Customers C
LEFT JOIN Orders O
  ON C.CustomerID = O.CustomerID
UNION
SELECT C.CustomerName, O.OrderID
FROM Customers C
RIGHT JOIN Orders O
  ON C.CustomerID = O.CustomerID;
```

### 4-8. SELF JOIN 예시

```sql
SELECT A.CustomerName AS CustomerName1,
       B.CustomerName AS CustomerName2,
       A.City
FROM Customers A, Customers B
WHERE A.CustomerID <> B.CustomerID
  AND A.City = B.City;
```

---

## 5. 실행 체크 리스트

1. XAMPP에서 Apache, MySQL 둘 다 **Start**
2. phpMyAdmin에서 `testdb` / `exercise_sql` 생성
3. `C:\xampp\htdocs\php_cheatsheet\`에 모든 파일 저장
4. 브라우저에서:

   * `http://localhost/php_cheatsheet/hello.php`
   * `http://localhost/php_cheatsheet/form_get.html`
   * `http://localhost/php_cheatsheet/form_post.html`
   * `http://localhost/php_cheatsheet/form_db.html`
   * `http://localhost/php_cheatsheet/list_db.php`
5. 값 넣어보고 DB에 들어갔는지 phpMyAdmin에서 확인
