# SQL INJECTION WRITEUP 
---
###### tags: `PortSwigger` `Writeup`

## 1. Lab: SQL injection vulnerability in WHERE clause allowing retrieval of hidden data
![](https://i.imgur.com/z5Rwcwt.png)
- Lab này yêu cầu em thực hiện tấn công kiểu SQL Injection vào trang web khiến trang web hiện tất cả những mặt hàng có trong danh sách, cả những mặt hàng đã được ra mắt và chưa ra mắt
- Lab đã cho em biết được nơi mà em có thể khai thác SQL Injection, là chỗ phân loại sản phẩm, nên em đã vào BurpSuite để bắt lấy request chọn category:
    ![](https://i.imgur.com/x3GPIGg.png)
- Em đưa tab này Repeater, rồi chỉnh sửa đoạn request 
    + Đầu tiên, câu lệnh kia sẽ phân loại theo tên category và yếu tố released = 1, nên công việc của em là: chèn vào 1 phần tử luôn đúng, khi đó sẽ không còn có chuyện phân loại theo tên category, và làm cho yếu tố released = 1 vô dụng.
    + Em đã thực hiện SQL Injection bằng cách thêm dấu ' để kết thúc chuỗi truyền vào category, và thêm điều kiện `or '1' = '1'` , vì 1 luôn bằng 1 nên nó sẽ hiện hết các sản phẩm do câu lệnh SQL là SELECT * (chọn hết), sau đó tiếp tục thêm phần `--` là ký hiệu của chú thích, nghĩa là sau dấu `--` tất cả sẽ vô nghĩa, nên phần lệnh `AND released = 1` đã trở nên vô nghĩa.
- Như vậy, sau khi chỉnh sửa ở repeater thành công, em đã xem được những sản phẩm còn chưa ra mắt bằng cách thay đổi cách hoạt động của câu lệnh SQL:
    ![](https://i.imgur.com/lXaARHb.png)
- Em đã solve được lab trên:
    ![](https://i.imgur.com/dJtVP0t.png)

## 2. Lab: SQL injection vulnerability allowing login bypass
![](https://i.imgur.com/t6PMT6L.png)
- Lab này chứa một lỗ hổng SQL Injection ở phần đăng nhập, để giải quyết lab này, em cần phải thực hiện SQL injection để đăng nhập vào ứng dụng với tài khoản admin
- Em đoán rằng câu lệnh SQL sẽ na ná như: SELECT * WHEN `username` = 'username' AND `password` = 'password'
- Nên em đã thực hiện việc SQL Inject vào tài khoản: `0' or '1' = '1' --`
    + `0'` là để đóng chuỗi nhập vào biến username trong database
    + `or '1' = '1'` là để kèm theo điểu kiện luôn đúng, khiến em sẽ có thể đăng nhập vào với bất kỳ tài khoản nào
    + `--` là để chú thích lại điều kiện AND password, khiến em có thể đăng nhập với bất kỳ mật khẩu nào
- Em đã đăng nhập với tài khoản như vậy mà mật khẩu `1`:
    ![](https://i.imgur.com/dK6dFxy.png)
- Đăng nhập thành công, em đã solve được lab: 
    ![](https://i.imgur.com/9pqjMKT.png)

## 3. SQL injection UNION attack, determining the number of columns returned by the query
![](https://i.imgur.com/2n5vvGj.png)
- Lab trên chứa một lỗ hổng trong cơ chế lọc category, kết quả của query sẽ được hiện ở trong kết quả trả về ở phía người dùng, nên ta có thể thực hiện tấn công qua UNION để lấy được dữ liệu từ những bảng khác.
- Công việc đầu tiên là lấy được số cột sẽ được trả về của query, để solve được lab, em cần thực hiện SQL Injection tấn công theo UNION để trả về thêm hàng mang giá trị null.
- Đầu tiên, em đưa tab filter category vào Repeater trong BurpSuite để thay đổi tham số category. Sau quá trình tìm hiểu, em thấy ta có thể biết được số cột mà query có thể trả về bằng cách đưa từng giá trị NULL vào table, đến khi nào server trả về cho em Hàng với giá trị NULL, thì ta xác định được số cột của response.
    ![](https://i.imgur.com/1biP2vZ.png)
- Em đã thực hiện theo bằng cách thêm vào phần tham số của `filter/?category=Accesories'+UNION+SELECT+NULL--`
    + Với dấu ' là để ngắt input vào tham số accesories, UNION SELECT để khởi tạo UNION và thêm 1 số NULL, đồng thời chú thích để ngắt những câu lệnh đằng sau.
    ![](https://i.imgur.com/Jt1Ebnv.png)
    + Em phát hiện thấy lỗi server, chứng tỏ em chưa thêm đủ giá trị NULL, nên em tiếp tục thêm những giá trị NULL nữa.
    ![](https://i.imgur.com/ehi1zFt.png)
    + Đến giá trị NULL thứ 3 thì query trả về cho em 3 giá trị NULL của table, chứng tỏ UNION có 3 cột
    ![](https://i.imgur.com/YxZcpiw.png)
- Như vậy, em đã solve được lab với `/filtercategory=Accesories'+UNION+SELECT+NULL,NULL,NULL--`
    ![](https://i.imgur.com/0paYz6G.png)


## 4. Lab: SQL injection UNION attack, finding a column containing text
![](https://i.imgur.com/kcQLjcA.png)
- Lab này có chứa lỗ hổng SQL Injection ở cơ chế lọc category. Giờ em cần phải thực hiện tấn công kiểu UNION để tìm được cột nào đang ở dạng string 
- Đầu tiên, ta cần phải xem có bao nhiêu cột được trả về ở query, sử dụng kĩ thuật của lab trước, ta biết được query sẽ trở về 3 cột:
    ![](https://i.imgur.com/WtV4UUg.png)
- Sau đó, em sẽ thử từng giá trị của string vào các cột này, nghĩa là em sẽ thử xem cột nào mang giá trị `Nq9tWY`, bằng cách thay giá trị null bằng `Nq9tWY`, cụ thể như sau:
    ![](https://i.imgur.com/CFY7CaK.png)
    + Em thay giá trị NULL đầu tiên và lỗi server, nên em tiếp tục chuyển sang thay giá trị NULL thứ hai, và ta đã hiện ra dữ liệu cần:
    ![](https://i.imgur.com/2LPGGYc.png)
- Như vậy, em đã solve được lab.


## 5. Lab: SQL injection UNION attack, retrieving data from other tables
![](https://i.imgur.com/W4aSB24.png)
- Lab này chứa một lỗ hổng SQL Injection ở cơ chế lọc category, ta cần tấn công bằng UNION để lấy dữ liệu từ các bảng khác, trong cơ sở dữ liệu của một bảng `user` có 2 cột là `username` và `password`
- Để solve được lab, em cần phải lấy được hết tài khoản và mật khẩu, rồi dùng thông tin đó để đăng nhập với người dùng admin
- Sau khi biết được queery trả về là 2 cột, em tiến hành lấy username và pasword ở bảng user bằng câu lệnh: `UNION SELECT... FROM...` Cụ thể ở đây là: `UNION SELECT username,password FROM users`. Thay đổi với cấu trúc đó ở trong Repeater, em đã có được thông tin về tài khoản và mật khẩu của administrator:
    ![](https://i.imgur.com/7p08CkO.png)
- Tài khoản của admin đã có, với username là: **administrator**, password là: **6exmkfzh12ryyb6xt8rn**, đăng nhập với username và tài khoản trên, em đã solve được lab.
    ![](https://i.imgur.com/RPBYye0.png)

## 6. Lab: SQL injection UNION attack, retrieving multiple values in a single column
![](https://i.imgur.com/dI7kj3a.png)
- Lab này yêu cầu em thực hiện tấn công SQL Injection bằng UNION với mục đích lấy ra được nhiều thông tin ra chỉ trong một cột, mà ở đây là lấy được thông tin của username và password trong bảng user
- Ban đầu em xác định được query trả về cho em được 2 cột:
    ![](https://i.imgur.com/y3Ngvam.png)
- Bây giờ em muốn lấy cả tài khoản và mật khẩu chỉ trong 1 cột, mà cột còn lại mang giá trị NULL thì phải làm sao
    ![](https://i.imgur.com/Ed5reG0.png)
- Sau khi tìm hiểu thì em đã biết được cách, đó chính là nối chuỗi với toán tử `||`, và em sẽ nối ở giữa 1 ký tự nào đó không xuất hiện trong cả tài khoản và mật khẩu để dễ quan sát hơn, cụ thể thì em đã thực hiện biến đổi tham số category như sau: `/filter?category=Accessories'+UNION+SELECT+NULL,username||'-'||password+FROM+users--`
    + Với ký tự `'-'` để phân tách giữa 2 chuỗi tài khoản và mật khẩu
    + Và dấu `||` để tách chuỗi
    ![](https://i.imgur.com/eW4JgWQ.png)
    + Kết quả ở đây đã thể hiện rõ, tài khoản và mật khẩu được tách nhau bởi dấu "-", em đã có tài khoản administrator:
        + username: **administrator**
        + password: **w2az38x2ho1vu35kynhr**
- Đăng nhập với tài khoản trên, em đã solve được lab:
    ![](https://i.imgur.com/iy0Gwng.png)

## 7. Lab: SQL injection attack, querying the database type and version on Oracle
![](https://i.imgur.com/I9gC71c.png)
- Lab trên có chứa lỗ hổng SQL ở cơ chế lọc category, em cần phải hiện ra được phiên bản của database dưới dạng string bằng UNION
- Để hiện được phiên bản của database cũng như loại database, ta có thể sử dụng những câu lệnh như:

| Loại Databse | Câu Lệnh URL sử dụng |
| -------- | -------- |
|Microsoft|‘+UNION+SELECT+@@version|
|Oracle|‘+UNION+SELECT+BANNER,NULL+FROM+v$version--|
|PostgreSQL|‘+UNION+SELECT+version()|
|MySQL|‘+UNION+SELECT+@@version|

- Đầu tiên, em cần phải tìm được số cột của query trả về, vì đây Oracle, em có thể dùng `order by 1` hoặc là `select null from dual`
    ![](https://i.imgur.com/DE6Zyyj.png)
- Query trả về cho ta 2 cột, sau đó em phải tìm xem cột nào trả về giá trị là chuỗi, thì em sẽ đưa chuỗi vào lần lượt từng cột:
    ![](https://i.imgur.com/xk2jftY.png)
- Nhờ đó ta biết được cột 1 mang giá trị string, giờ em sẽ trỏ cột 1 vào để cột 1 hiện ra phiên bản của Oracle.
    ![](https://i.imgur.com/kRecYYv.png)
- Như vậy, em đã solve được lab.

## 8. Lab: SQL injection attack, querying the database type and version on MySQL and Microsoft
![](https://i.imgur.com/qv1vGsN.png)
- Lab này yêu cầu em thực hiện SQL Injection bằng UNION nhằm hiện ra được thông tin của loại cũng như phiên bản của database của trang web.
- Ban đầu em cần xác định query trả về bao nhiêu cột:
    ![](https://i.imgur.com/aHWU3Nb.png)
    ![](https://i.imgur.com/IbCa2iV.png)
    + Em `order by` để xác định số cột mà union có thể có, và khi em nhập đến 3 thì đã có lỗi xảy ra, điều này chứng tỏ query chỉ trả về 2 cột
- Sau khi xác định được số cột, em cần phải xem cột nào có thể chứa được giá trị chuỗi:
    ![](https://i.imgur.com/mdoh0SO.png)
    + Sau khi gán giá trị chuỗi vào cột 1, em có thể thấy nó hiện về được, nên em xác định cột 1 sẽ là cột để hiện ra được thông tin chuỗi
- Gán vào cột 1 với biến `@@version` để hiện ra phiên bản của loại database MySQl và Microsoft, em đã solve được lab:
    ![](https://i.imgur.com/QRUM8wX.png)

## 9. Lab: SQL injection with filter bypass via XML encoding
![](https://i.imgur.com/Edq4hE6.png)
- Lab trên chứa một lỗ hổng SQL Injection ở tính năng kiểm tra hàng hóa. Kết quả của query trả về cho người dùng, nhiệm vụ của ta là phải lấy được thông tin từ bảng users, từ đó lấy được tài khoản và mật khẩu của admin.
- Đầu tiên ta cần phải xác định xem UNION có thể lấy được bao nhiêu cột, tuy nhiên khi em sử dụng câu lệnh UNION SELECT NULL và chữ **S** được mã hóa theo **Html Encode**, trang web đã phát hiện ra em thực hiện tấn công trang web và nó đã in ra như này:
    ![](https://i.imgur.com/PUnvyZH.png)
- Em không thể tấn công theo cách bình thường như này, nên em cần phải sử dụng thêm extension có trong BurpSuite là Hackvertor, công cụ này sẽ biến đổi payload và mã hóa theo nhiều dạng khác nhau, tiêu biểu như: base64,... Ở đây em sẽ encode câu query của em theo dạng hex_entities để vượt qua được tường lửa của trang web:
    ![](https://i.imgur.com/6rugOUw.png)   
    ![](https://i.imgur.com/3ChFIaB.png)
- Như vậy em đã biết được UNION trả về 1 cột, sau đó em cần check xem liệu em có thể truyền được thông tin từ bảng users ra được không
    ![](https://i.imgur.com/980yQnf.png)
- Em thấy đã có thể thực hiện được việc truyền thông tin ra, nên em tiến hành thực hiện nối chuỗi để lấy được thông tin của các tài khoản và mật khẩu ra từ table users:
    ![](https://i.imgur.com/iSqhtTw.png)
- Như vậy em đã có tài khoản. Với username:`administrator` và password: `f082e0qfxhre1dyskbib`thực hiện nhập tài khoản admin vào, em đã solve được lab:
    ![](https://i.imgur.com/RrcGxZj.png)

## 10. Lab: SQL injection attack, listing the database contents on non-Oracle databases
![](https://i.imgur.com/SeYqzTc.png)
- Lab này có chứa lỗ hổng SQL Injection ở cơ chế phân loại sản phẩm, nhiệm vụ của em là cần tìm được bảng có chứa tên tài khoản và mật khẩu, từ đó lấy được thông tin của admin.
- Đầu tiên, em vẫn cần phải tìm được UNION này trả về cho em bao nhiêu cột, em sử dụng `Select null-- -` và em biết được UNION sẽ đưa về cho em 2 cột
    ![](https://i.imgur.com/SjmWg30.png)
- Em biết được đây không phải Oracle, nên luôn tồn tại 1 bảng information_schema chứa tên các bảng, loại các bảng, đồng thời kiểm tra cho em thấy 2 cột của UNION đều có thể trả về cho em dạng chuỗi, nên em tiến hành tìm tên tables trong information_schema.tables
- Với câu query là: 
```sql!=
'+union+select+table_name,null+from+information_schema.tables--+-
```
-  câu lệnh này sẽ trả về hết cho em các tên bảng có trong cơ sở dữ liệu:
    + `tabe_name`: tên các bảng có trong CSDL
    + `information_schema.tables`: bảng chứa tên các bảng có trong CSDL
![](https://i.imgur.com/pxNWL9Q.png)
- Như chúng ta có thể thấy, có rất nhiều bảng tên user, có một số bảng khá đáng ngờ trong trang web này như: 
    + users_zcuejx
    + pg_stat_user_tables
    + pg_stat_xact_user_tables
    + pg_user
- Em sẽ thử lấy các cột của từng bảng bằng câu lệnh: 
```sql!
+union+select+column_name,null+from+information_schema.columns+where+table_name='users_zcuejx'--+-
```
![](https://i.imgur.com/9oF0ngv.png)
- Thật may mắn là vì ngay từ bảng đầu tiên, em đã có ngay được tên tài khoản và mật khẩu, công việc còn lại chỉ là hiện ra thông tin trên UNION bằng cách select từ bảng **'users_zcuejx'**
![](https://i.imgur.com/jDD1yrJ.png)
- Như vậy, em đã có tên tài khoản và mật khẩu, đăng nhập vào trang web, em đã solve được lab.
![](https://i.imgur.com/rrxseQy.png)

## 11. Lab: SQL injection attack, listing the database contents on Oracle
![](https://i.imgur.com/AdTaIpx.png)
- Trang web này có chứa lỗ hổng SQL Injectiong ở cơ chế phân loại hàng, nhiệm vụ của em vẫn giống lab trước, là tìm được tên bảng chứa tên tài khoản và mật khẩu, từ đó đăng nhập vào lab với tư cách là administrator.
- Công việc đầu tiên vẫn là phải tìm được số cột mà UNION trả về, bằng câu query `ORDER BY 3--`, server đã trả về status 500, nghĩa là UNION của em chỉ trả về 2 cột:
![](https://i.imgur.com/5wHinvC.png)
- Sau đó em tiếp tục sử dụng query để liệt kê những tên bảng có trong bảng gốc all_tables mặc định của Oracle:
![](https://i.imgur.com/MJK8uEo.png)
- Câu query có cấu trúc: 
```sql!=
'+union++select+table_name,null+from+all_tables--+-
```
- Có một số bảng khá đáng ngờ là:
    + USERS_LVQGXY
    + APP_USERS_AND_ROLES
    + SDO_PREFERRED_OPS_USER
- Em thử hiện ra tất cả các cột của bảng đầu tiên sử dụng cấu trúc:
```sql!
'+union+select+column_name,null+from+all_tab_columns+where+table_name='USERS_LVQGXY'--+-
```
- Ngay từ ở bảng đầu, nó đã cho em 2 cột là username và password, đây chính là bảng em cần tìm:
![](https://i.imgur.com/06Ph9Bs.png)
- Giờ chỉ cần thực hiện lấy thông tin ra từ bảng USERS_LVQGXY là xong:
![](https://i.imgur.com/CdOp8d9.png)
- Em đã có được thông tin của administrator, đăng nhập vào trang web và em đã solve được lab này:
![](https://i.imgur.com/qa5iWs6.png)


## 12. Lab: Blind SQL injection with conditional responses
![](https://i.imgur.com/LqUqQqE.png)
- Lab này có chứa lỗ hổng Blind SQL Injection, khi trang web này lữu trữ cookie và phân tích nó, và ta có thể dựa vào cách trang web phản hồi để đoán vì trang web này sẽ không hiện kết quả của câu lệnh query mà ta nhập vào, nhưng nếu query có trả về kết quả thì trang web sẽ hiện "Welcome back"
- Có một bảng tên là "users" chứa tên tài khoản và mật khẩu, em cần phải lấy được mật khẩu của admin để solve được lab này
- Vì đây là blind SQL Injection, nên việc dùng UNION là khá khó khăn do không nhìn thấy được kết quả của query, việc tìm mật khẩu của admin sẽ chủ yếu là tìm từng từ một, và sử dụng tab Intruder của BurpSuite
- Đầu tiên em sẽ xem trang web phản ứng ra sao nếu em chèn thêm vào câu query 1 thứ luôn đúng, chẳng hạn như '1'='1':
![](https://i.imgur.com/322VjBx.png)
- Như ta có thể thấy, việc truy vấn thành công do trang web hiện về cho em chữ "Welcome back", nghĩa là giờ cách làm của bài này sẽ là: truyền vào một câu query, nếu nó đúng thì sẽ trả về "Welcome back", còn nếu nó không đúng thì nó sẽ không trả về gì
- Em đã biết tên tài khoản là 'administrator', việc đầu tiên cần làm là xem liệu mật khẩu dài bao nhiêu ký tự
```sql!
'+and+(select+'a'+from+users+where+username='administrator'+and+length(password)>1)='a'--+-
```
- Câu query trên của em nghĩa là: em sẽ chọn ra chữ a nếu trong bảng users có username là administrator và độ dài của password lớn hơn 1. Điều này có nghĩa chỉ khi cả 2 yếu tố là trong bảng users có username là administrator và độ dài của password lớn hơn 1 thì câu lệnh này mới là đúng, và trang web mới trả về chữ "Welcome back".
![](https://i.imgur.com/jpxIGQh.png)
- Cứ tiếp tục tăng như vậy cho đến 20, ta không còn thấy welcome xuất hiện nữa, ta khẳng định rằng password có 20 ký tự
![](https://i.imgur.com/zTMTS8l.png)
- Như vậy ta đã có được độ dài của mật khẩu, em sẽ sử dụng tab intruder để bruteforce lấy từng ký tự trong mật khẩu của admin bằng câu query
```sql!=
'+and+(select+substring(password,1,1)+from+users+where+username='administrator')='a'--+-
```
- Với câu query như này, nếu chuỗi con mang ký tự đầu tiên của chuỗi là 'a' thì trang web mới trả về cho ta dòng "Welcome back", ta bắt đầu tiến hành bruteforce
![](https://i.imgur.com/voiGykX.png)
- Tại 2 vị trí: vị trí lấy xâu con và chữ cái thử. Với vị trí lấy xâu con chạy từ 1 đến 20, còn chữ cái thử là chữ thường a-z và số 0-9. Chọn mode ClusterBomb và bắt đầu bruteforce
- Chỉ cần có trường hợp nào trả về welcome back thì đó chính là ký tự đúng trong password của admin
![](https://i.imgur.com/AFbq03g.png)
- Kết quả bruteforce đã có, em sẽ tổng hợp lại thành mật khẩu như sau: ***nionodubzwpsm383cr4f***
- Đăng nhập với tài khoản và mật khẩu trên và em đã solve được lab
![](https://i.imgur.com/4bi2tJg.png)

## 13. Lab: Blind SQL injection with conditional errors
![](https://i.imgur.com/86cy3jV.png)
- Lab trên có chứa lỗ hổng blind SQL Injection trong quá trình lưu trữ và phân tích cookie, đồng thời thực hiện một câu lệnh SQL có chứa giá trị của cookie đó
- Kết quả của câu query không được hiện ra, và trang web cũng không trả về bất cứ thứ gì trong trường hợp query có trả về hàng nào hay không. Nhưng nếu câu lệnh SQL query không thực thi được thì ứng dụng sẽ trả về thông báo lỗi
- Trong CSDL của trang web có chứa một bảng là `users`, với 2 cột là `username` và `password`. Nhiệm vụ của chúng ta là đăng nhập với tư cách là administrator.
- Ta sẽ không thể làm việc như lab bên trên nữa vì dù query có trả về hàng hay không thì trang web cũng không hề show ra bất kỳ thứ gì, nên ta cần phải phải tiếp cận theo một hướng khác, đó là cố tình biến câu query thành sai để trang web báo lỗi.
- Đầu tiên ta cần xác định xem dạng CSDL của trang web là gì, từ đó sử dụng câu query phù hợp, ở đây trang web đã sử dụng Oracle, nên ta cần phải cân nhắc sử dụng đúng kiểu:
- Đầu tiên sẽ là check xem mật khẩu của ta dài bao nhiêu ký tự, sử dụng cấu trúc này, nếu mật khẩu > 20 ký tự thì nó sẽ báo về lỗi (status 500) vì nếu điều kiện mật khẩu > 20 ký tự là đúng nó sẽ thực hiện phép tính 1/0 và gặp lỗi ở đấy, tuy nhiên ở đây khi dùng điều kiện mật khẩu > 20 ký tự thì nó lại trả về status 200, nghĩa là câu điều kiện này đã sai, từ đó ta có thể khẳng định mật khẩu của tài khoản administrator dài 20 ký tự:
```sql!
'+||+(SELECT+CASE+WHEN+LENGTH(password)>20+THEN+TO_CHAR(1/0)+ELSE+''+END+FROM+users+WHERE+username='administrator')+||+'
```
![](https://i.imgur.com/33Kafuh.png)
- Thể hiện chắc chắn hơn ở việc bruteforce thì từ điều kiện > 20 ký tự, lớn hơn 20 đều trả về status 200:
![](https://i.imgur.com/0bmCO0A.png)
- Sau đó ta chỉ cần tiến hành bruteforce lấy từng ký tự của mật khẩu, chỉ cần trả về status 500 thì đó chính là ký tự đúng
![](https://i.imgur.com/mJWe7Do.png)
```sql!
'+||+(SELECT+CASE+WHEN+SUBSTR(password,+§1§,+1)='§a§'+THEN+TO_CHAR(1/0)+ELSE+''+END+FROM+users+WHERE+username='administrator')+||+'
```
- Kết quả bruteforce ta có:
![](https://i.imgur.com/PEewOGh.png)
- Như vậy, mật khẩu của tài khoản admin là: **04f6rwbo9u1t5aq1ih0n**
- Đăng nhập với thông tin trên, em đã solve được lab
![](https://i.imgur.com/ZfxmEVn.png)

## 14. Lab: Blind SQL injection with time delays
![](https://i.imgur.com/DBkhSae.png)

---

# DIRECTORY TRAVERSAL WRITE UP
---
###### tags: `PortSwigger` `Writeup`

## 1. Lab: File path traversal, simple case
![](https://i.imgur.com/oPTDedN.png)
- Lab này có chứa lỗ hổng file path traverval trong phần giao diện ở mục ảnh sản phẩm, để solve lab thì em cần lấy thông từ file /etc/passwd
- Đầu tiên, em đưa trang web này BurpSuite để xem xét
- Đưa tab view detail của một sản phẩm bất kỳ vào tab Repeater để tiến hành thay đổi đường dẫn
- Thì em thấy đường dẫn của 1 ảnh thường sẽ như này
    ![](https://i.imgur.com/BSJ79q1.png)
- Ở tab Repeater, em thay đổi đường dẫn, không phải là `GET product?productID= ` nữa mà là `GET image?filename= `, thì nếu em để địa chỉ là `3.jpg`, nó sẽ trả về cho em ảnh trên
![](https://i.imgur.com/JZgI1Gr.png)
- Em sẽ tiến hành đọc file /etc/passwd bằng cách sử dụng `../`, nó có nghĩa là trở về thư mục cha của thư mục hiện tại, thì em đã thử dùng 1 lần, 2 lần, rồi đến lần thứ 3 là đã trả về được thư mục root, em đã có thể xem được file
![](https://i.imgur.com/oANn4xw.png)
- Như vậy, em đã solve được lab

## 2. Lab: File path traversal, traversal sequences blocked with absolute path bypass
![](https://i.imgur.com/Pf0PXW8.png)
- Lab này có chứa lỗ hổng file path traversal trong cơ chế hiện ảnh sản phẩm.
- Trang web trên đã chặn những dấu `../` nên em không thể dùng cách như lab trước, nên em phải tìm cách khác. Để solve được lab trên em cần phải xem được nội dung của file etc/passwd
- Đầu tiên em vẫn sẽ đưa trang web này vào BurpSuite rồi đưa vào tab Repeater để xem xét
- Vì trang web đã block cách sử dụng `../` nên em đã nghĩ đến việc sử dụng đường dẫn tuyệt đối:
- Bằng cách trỏ thẳng filename đến etc/passwd: 
```
/image?filename=/etc/passwd
```
- Em đã có thể xem được file etc/passwd luôn mà không cần phải dùng traversal sequences
![](https://i.imgur.com/JMT2p08.png)
- Như vậy, em đã solve được lab trên
![](https://i.imgur.com/HpVslZ0.png)

## 3. Lab: File path traversal, traversal sequences stripped non-recursively
![](https://i.imgur.com/NVIohHY.png)
- Lab này có chứa lỗ hổng File Traversal trong cơ chế hiện hình ảnh của sản phẩm
- Khi sử dụng dãy `../` để truyền vào filename thì trang web sẽ gỡ rối ra trước khi thực thi. Để solve được lab em cần phải xem được thông tin của file /etc/passwd
- Vì trang web có cơ chế sẽ gỡ 1 lần `../` nên em đã nghĩ đến sử dụng cách là sử dụng `...//` thay vì chỉ 1 lần `../`, khi đó trang web sẽ gỡ rối ra và em vẫn còn `../`, sử dụng 3 lần, em đã duyệt đến thư mục root và xem được file /etc/passwd
![](https://i.imgur.com/lypyI7E.png)
- Như vậy, em đã solve được lab 
![](https://i.imgur.com/bbv5Pma.png)

## 4. Lab: File path traversal, traversal sequences stripped with superfluous URL-decode
![](https://i.imgur.com/j9iwWrX.png)
- Lab này có chứa lỗ hổng file path traversan ở cơ chế hiện hình ảnh sản phẩm
- Trang web này đã chặn tất cả những input có chứa ký tự duyệt qua `../`. Trang web sẽ biến về dạng URL-Decode input trước khi thực thi
- Để solve được lab, em cần phải xem được nội dung của file /etc/passwd
- Vì lab bảo rằng trang web sẽ URL-Decode input của em trước khi thực thi, nên em đã tiến hành URL-Encode `../../../` 2 lần rồi đưa vào input, cụ thể là:
![](https://i.imgur.com/S28Bw39.png)
- Sử dụng nó vào câu request, em đã xem được nội dung của file /etc/passwd
```!
GET /image?filename=%25%32%65%25%32%65%25%32%66%25%32%65%25%32%65%25%32%66%25%32%65%25%32%65%25%32%66/etc/passwd
```
![](https://i.imgur.com/QRL3mce.png)
- Như vậy, em đã solve được lab
![](https://i.imgur.com/GeDcVaA.png)

## 5. Lab: File path traversal, validation of start of path
![](https://i.imgur.com/qLBgNYh.png)
- Trang web này sẽ chuyển toàn bộ đường dẫn đến file như một tham số yêu cầu, và sẽ thực thi nếu đường dẫn đó có thư mục ban đầu(base folder)
- Giờ em sẽ thay đổi trong tab Repeater, thay vì chỉ dùng `../` thì em sẽ gán thêm folder đầu tiên mà em chọn để lấy thông tin, cụ thể là lấy ảnh, đó là: `/var/www/images`, đây là thư mục gốc để có thể trỏ đến các ảnh, nên em bắt đầu thực hiện qua folder từ đó:
![](https://i.imgur.com/eaId4qs.png)
- Như vậy, em đã solve được lab:
![](https://i.imgur.com/Ff6S2HL.png)

## 6. Lab: File path traversal, validation of file extension with null byte bypass
![](https://i.imgur.com/Jsv5rks.png)
- Trang web này sẽ chỉ duyệt những những đường dẫn filename mà có định dạng đuôi file đúng với định dạng được qui định
- Ở đây em bypass từ chỗ tìm kiếm ảnh, nên hiện tại đường dẫn filename của em cần phải kết thúc bằng đuôi .jpg
![](https://i.imgur.com/RnNKSxh.png)
(Em nghĩ đấy là jpg vì ấn vào ảnh của các sản phẩm đều có đuôi là jpg)
- Vấn đề là, làm sao để em biến đường dẫn thành 1 file.jpg để bypass được trang web?
- Em đã nghĩ đến việc sử dụng byte NULL để bypass được đuôi file này, việc cần làm chỉ là thêm %00 vào cuối đường dẫn và thêm .jpg là em đã thực hiện bypass thành công, vì sau ký tự null thì đoạn .jpg ở đằng sau sẽ không có ý nghĩa nữa, vì bản chất của ký tự NULL là để kết thúc một chuỗi
![](https://i.imgur.com/gPKbkvV.png)
- Em đã solve được lab bằng cách đó: 
![](https://i.imgur.com/9Mw3aFV.png)

---

# OS COMMAND INJECTION WRITE UP
---
###### tags: `PortSwigger` `Writeup`

## 1. Lab: OS command injection, simple case
![](https://i.imgur.com/77SHOyG.png)
- Lab này có chứa một lỗi OS command injection trong cơ chế kiểm tra hàng hóa, trang web sẽ thực hiện câu lệnh với input là storeID và ID sản phẩm, rồi return output nguyên thủy
- Để solve được lab, em cần thực hiện câu lệnh `whoami` để xem ai đang là người dùng
- Đầu tiên em đưa trang web dùng để check stock vào tab Repeater để xem xét, thì có 2 tham số chính đóng vai trò trong việc check, là productID và storeID, giờ để thực hiện được câu lệnh `whoami` thì em phải chèn nó vào chỗ này
- Thì em sử dụng dấu & để ngăn cách các câu lệnh với nhau, em đã thêm `&whoami&` vào giữa 2 câu truyền này, và em đã url encode nó, gửi request đi và nó trả về ai đang dùng máy trên, cùng với thông báo lỗi vì nó không tìm thấy sản phẩm nào thỏa mãn các điều kiện trên
![](https://i.imgur.com/cHiigGz.png)
- Như vây, em đã solve được lab
![](https://i.imgur.com/wowOZ9m.png)

## 2. Lab: Blind OS command injection with time delays
![](https://i.imgur.com/iwl9tQK.png)
- Lab trên có chứa lỗ hổng OS command injection trong cơ chế gửi feedback, kết quả của output không hiện ra trang web
- Để solve được lab thì em cần phải thực hiện delay request 10s
- Thì cách tốt nhất để thực hiện delay của 1 trang web là câu lệnh: `ping -c 10 127.0.0.1`
- Bây giờ em phải nhét câu lệnh này vào phần email ở trong phần feedback, vì cơ chế thực thi của feedback là khi em điền thông tin và gửi feedback với email của em, thì trang web sẽ tạo 1 email gửi đến một trand admin mà chứa feedback của em, để làm được vậy thì nó cần phải gọi lại thông tin gồm địa chỉ email và feedback của em
- Vì vậy nên em mới gài câu lệnh ping vào phần email, và câu trả lời của em đạt độ trễ gần 10 giây:
![](https://i.imgur.com/wKN5Zjj.png)
![](https://i.imgur.com/D32U1HY.png)
- Như vậy, em đã solve được lab: 
![](https://i.imgur.com/5vVicRg.png)

## 3. Lab: Blind OS command injection with output redirection
![](https://i.imgur.com/ECNAnnF.png)
- Lab này vẫn sẽ không hiện ra output cho chúng ta, nhưng chúng ta có thể chuyển hướng output để lưu được ouput ở trong folder `/var/www/images/`, trang web sẽ thực thi như là thực thi với 1 ảnh, nên ta cần phải điều hướng output trong phần injected command đến file images, rồi dùng ảnh đó để thu được nội dung của file
- Để solve được lab, em cần thực thi câu lệnh `whoami` và lấy được output của nó
- Em đã dùng dấu `||` thay cho `&` để chèn câu lệnh whoami, đồng thời lưu kết quả đó vào file whoami.txt theo đường dẫn: /var/www/images/
![](https://i.imgur.com/LQn7RN9.png)
- Bằng câu lệnh`||whoami > /var/www/images/whoami.txt||`, em đã thực thi câu lệnh whoami, và lưu kết quả của câu lệnh whoami vào file theo chỉ định
- Việc lưu trữ đã thành công, sau đó em truy xuất vào `/image?filename=whoami.txt` để hiện ra được kết quả:
![](https://i.imgur.com/6phIQ7q.png)
- Như vậy, em đã solve được lab
![](https://i.imgur.com/7xyvvdj.png)


