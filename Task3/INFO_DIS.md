# PORT SWIGGER WRITE UP: INFORMATION DISCLOSURE

## 1. Lab: Information disclosure in error messages
![](https://i.imgur.com/pOf2B45.png)

- Lab trên yêu cầu em tìm framework của bên thứ 3 mà trang web đang sử dụng, rồi submit số hiệu phiên bản của nó.
- Phải nói framework của bên thứ 3 là gì đã trước, em hiểu nó là thư viện phần mềm đã được dựng sẵn code có thể tái sử dụng, còn nó của bên thứ 3 là vì thư viện này không phải của người code web làm ra mà của 1 bên thứ 3 phát triển.
- Đầu tiên em đưa link trang web này vào BurpSuite, và em ấn thử vào 1 sản phẩm, thì em thấy trên URL sản phẩm được đánh dấu khác nhau dựa vào product ID.
    ![](https://i.imgur.com/PeHqdLe.png)
    ![](https://i.imgur.com/f6bwmIE.png)
- Ví dụ id = 1 sẽ là cái để treo bia, id = 2 sẽ là cái thuyền, cứ như vậy, em nhận ra tất cả các sản phẩm này được đánh dấu theo id là số bắt đầu từ 1, em đã thử xem nếu em nhập vào id là 1 chuỗi thì nó sẽ xử lý như nào, vì em biết không có sản phẩm nào có id là chuỗi: 
    ![](https://i.imgur.com/efGUfbB.png)
- Server đã báo lỗi ngay lập tức, với status 500 đồng thời lộ ra framework là : **Apache Struts 2 2.3.31**
- Submit: **2 2.3.31** , em đã solve được lab.
    ![](https://i.imgur.com/oFvotgg.png)

## 2. Lab: Information disclosure on debug page
![](https://i.imgur.com/asta3Eg.png)

- Lab này có chứa 1 trang web debug mà có những thông tin bí mật liên quan đến ứng dụng, để solve được lab, em cần phải nộp giá trị của biến SECRET_KEY
- Bài này em khá là hên, đầu tiên em đưa trang web vào BurpSuite, và ở trang web page chính, hay khi em bấm vào bất kì 1 sản phẩm nào nó đều có 1 comment có link dẫn đến 1 trang web:
    + Homepage:
        ![](https://i.imgur.com/aDp9tRi.png)
    + Sản phẩm bất kì:
        ![](https://i.imgur.com/H48AcOM.png)
- Em đã send ngay Homepage đến Repeater rồi sửa đường dẫn đến **/cgi-bin/phpinfo.php>Debug** ,nhưng kết quả Not Found:
    ![](https://i.imgur.com/cOoPXpK.png)
- Nên em đã bỏ >Debug mà chỉ đưa đường dẫn đến /cgi-bin/phpinfo.php ,và trang web đã trả về cho em thông tin đầy đủ về phiên bản PHP cũng như cấu hình của phiên bản PHP trên:
    ![](https://i.imgur.com/be0f4q0.png)
- Em tìm thử biến SECRET_KEY trong respond, và thật bất ngờ là em đã tìm được giá trị của biến:
    ![](https://i.imgur.com/pP1ZAPT.png)
- Với giá trị của biến là: **mkwbgysbve0eu1l8wduskp60iuxr823n** ,em đã solve được lab.

## 3. Lab: Source code disclosure via backup files
![](https://i.imgur.com/1G72NkA.png)

- Lab này đã để lộ source code và file backup ở 1 thư mục ẩn, để solve được lab em phải tìm được và nộp mật khẩu của cơ sở dữ liệu, mà nó được giấu ở source code.
- Đầu tiên em chuyển hướng trang web đến robots.txt, thì em phát hiện điểm rất đáng ngờ là nó lại có 1 thư viện ẩn là: /backup
    ![](https://i.imgur.com/BXQT0zq.png)
- Em sử dụng chức năng Target, thẻ Site map, sau khi ấn vào em lại thấy 1 thư mục backup và có 1 đường dẫn, em đã đưa nó sang tab Repeater để lấy kết quả
    ![](https://i.imgur.com/fketxR7.png)
    ![](https://i.imgur.com/zpqUSqd.png)
- Tại đây tiếp tục có 1 đường dẫn tiếp theo của backup là /backup/ProductTemplate.java.bak ,nên em tiếp tục gửi request theo đường dẫn đấy để xem kết quả trả về như thế nào:
    ![](https://i.imgur.com/ZvBb28I.png)
- Ở request em đã thấy password của database là: **izrx7l2as02qp06nyrz7ykfzugrlwjjg**. Như vậy, em đã solve được lab
    ![](https://i.imgur.com/al7p7rI.png)

## 4. Lab: Authentication bypass via information disclosure
![](https://i.imgur.com/t7uR8O7.png)

- Lab này kết hợp 2 đề tài authen và information disclosure, giờ em cần phải bypass authen bằng HTTP header và vào được giao diện của admin và xóa tài khoản carlos.
- Vì vấn đề chính của em bây giờ là vào được admin interfere, nên em đã đưa trang web vào BurpSuite và gửi vào repeat để GET /admin xem em có thể vào được không
    ![](https://i.imgur.com/XQBoTdQ.png)
- Respond trả về cho em kết quả rằng chỉ có địa chỉ mạng local mới có thể vào được admin interface, em muốn xem được cách thức mà server xử lý yêu cầu của em như thế nào, em đã sử dụng phương thức TRACE:
    ![](https://i.imgur.com/A7cQTDy.png)
- Server thực hiện request của em khá bình thường, nhưng chỉ có dòng `X-Custom-IP-Authorization` này đáng nghi, vì nó chứa địa chỉ IP của em, và em nghĩ đây chính là cái quyết định xem em có phải là admin hay không
- Vào phần proxy, em đã thêm vào header của mỗi request bằng chức năng Match anh Replace
    ![](https://i.imgur.com/vtglZPU.png)
- Giờ đây mỗi request em gửi sẽ gửi thêm dòng `X-Custom-IP-Authorization: 127.0.0.1`, việc sử dụng địa chỉ loopback sẽ chắc chắn rằng địa chỉ IP của em là localhost
- Giờ chỉ cần vào lại trang web là em đã có thêm tab Admin panel:
    ![](https://i.imgur.com/667rnVn.png)
- Admin panel interface:
    ![](https://i.imgur.com/K6WjNHp.png)
- Giờ chỉ cần xóa tài khoản carlos là em sẽ solve được lab: 
    ![](https://i.imgur.com/7kOnG9N.png)

## 5. Lab: Information disclosure in version control history
![](https://i.imgur.com/8x1hwsp.png)
