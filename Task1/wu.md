#          CHẾT.VN WRITE UP 

#  1. CHALLENGE 1:
- Đề bài:
     ![](https://i.imgur.com/59Qvc7R.png)
     
- Ở challenge này thì em thử ctrl U thì có ngay flag ạ:))
- Flag em có được ạ: `FLAG{ddf1ea89-cd89-4da3-98bc-08028ac4dc7e}`

# 2. CHALLENGE 2:
- Đề bài:
    ![](https://i.imgur.com/uFLqarl.png)
    
- Challenge này thì em cần phải giải mã lại đoạn flag đã bị mã hóa cho ở bên phải của code `1wc39mNzY4NDE1NTk9JD5vbm0mNDQ0PSQ5MHU9L2g+YHQ2NTB7dF5JU1`. Đoạn mã này đã bị mã hóa lần lượt là: str_rot13 -> bin2hex -> strrev -> hex2bin -> base64_encode. Nên để giải mã, em phải giải mã ngược lại, cụ thể là:
    + Với hàm str_rot13 nó đã dịch 13 ký tự trong bảng ASCII với số kí tự, nên em chỉ cần sử dụng tiếp câu lệnh trên thì đoạn mã sẽ trả lại ký tự cũ,
    + Hàm strrev là đảo ngược lại chuỗi, nên em đã sử dụng tiếp hàm đó thì nó sẽ đảo ngược về chuỗi cũ
- Em đã thử trong PhpSandbox và em có được flag như sau:
    ![](https://i.imgur.com/Pb9ncfT.png)
- Flag em có là: `FLAG{c564ca8b-5c94-4446-aba4-955148676bfc}`

# 3. CHALLENGE 3:
- Đề bài:
    ![](https://i.imgur.com/2z40RD1.png)
    
- Challenge này em cần truyền vào URL 1 tham số "number" sao cho giá trị của nó trả về mà 1337, nhưng không được truyền vào số 1337, vì nếu truyền vào số 1337 nó sẽ trả về 'no', nên em đã nghĩ đến việc truyền vào số 1337 với dấu cách, trong URL decode dấu cách là %20, nên payload của em cụ thể là `https://xn--cht-8jz.vn/challenge/3/?number=%201337` và em được flag như sau
    ![](https://i.imgur.com/pSWphdD.png)
- Flag em có là: `FLAG{554382f3-960e-4859-9c79-c64ecd4445e7}`

# 4. CHALLENGE 4:
- Đề bài:
    ![](https://i.imgur.com/vduYt1Y.png)
    
- Challenge này thì em cần phải truyền vào URL 2 tham số số "0" và "1" sao cho hai tham số này khác nhau, và MD5 hash của 2 số này giống nhau, em đã chọn mảng &0[] = 1 và &1[] = 2 vì em biết giá trị của nó khác nhau, nhưng khi khi md5 2 mảng này nó ra lỗi, 2 mảng cùng lỗi thì giống nhau, em đã thử với các số và nhận ra chỉ cần là 2 số khác nhau thì sẽ thỏa mãn nên em đã chọn 1 và 2. Nếu không chọn đúng theo yêu cầu đề bài thì em chắc phải chọn 1 cặp chuỗi mà cùng MD5 Hash mà có giá trị khác nhau, em đã thử và nó cũng đúng.
- Với payload đầy đủ là: https://xn--cht-8jz.vn/challenge/4/?0[]=1&1[]=2 , em có được flag như sau: 
    ![](https://i.imgur.com/wItbW8o.png)
- Flag em có là: `FLAG{82104890-f270-4d27-b4e4-638a940ffdcf}`

# 5. CHALLENGE 5:
- Đề bài:
    ![](https://i.imgur.com/TjdmKdz.png)
    
- Challenge này em cần phải truyền vào 1 file XML, file_get_content sẽ đọc file và convert file thành 1 chuỗi, còn hàm simplexml_load_string sẽ đưa file XML đấy về thành đối tượng và -> f chính là trỏ đến thẻ "f" của file XML vì trong file XML ta có thể tùy ý chỉnh tên thẻ, và cuối cùng là ép kiểu sang array và xét phần tử đầu giống 'flagggggggggggggg' không, cụ thể bài toán là tạo 1 file XML có 5 thẻ liên tiếp, với thẻ đầu tiên là thẻ head và 4 thẻ tiếp theo là thẻ f, l, a, g. Em đã viết file XML đấy rồi đẩy lên URL với pastebin, link URL của em là: https://pastebin.com/raw/LDfVw1wW
    ![](https://i.imgur.com/aYRtKel.png)
- Sau khi truyền URL này vào tham số "inp", với payload đầy đủ là: https://xn--cht-8jz.vn/challenge/5/?inp=https://pastebin.com/raw/LDfVw1wW , em có được flag: 
    ![](https://i.imgur.com/XmPEjap.png)
- Flag em có là: `FLAG{19ee9d17-7f23-4c03-b702-4276246ccdb2}`

# 6. CHALLENGE 6:
- Đề bài:
    ![](https://i.imgur.com/FS4D98I.png)
    
- Với challenge này thì em cần phải truyền vào URL tham số "number" sao cho nó là số, mà số đấy lại không được có chữ số 0 -> chữ số 9.
    + Hàm preg_match sẽ tìm trong tham số em truyền vào có chữ số 0 -> 9 nào không, nếu có sẽ trả về waf
    + Việc này dẫn đến em không thể truyền vào 1 số nào cả, kể cả dạng HEX
- Vậy nên em đã thử truyền vào theo dạng mảng, và nó hoạt động, em truyền vào là ?number[]=1. Payload đầy đủ của em là: https://xn--cht-8jz.vn/challenge/6/?number[]=1 . Em có được flag: 
    ![](https://i.imgur.com/PXjjSrH.png)
- Flag em có được là: `FLAG{2352ca3b-c94e-450b-b69a-1938cab26571}`

# 7. CHALLENGE 7:
- Đề bài:
    ![](https://i.imgur.com/B0jBb8X.png)
    
- Challenge này đòi hỏi em phải truyền vào một mảng u sao cho nó phải giống hệt với mảng user với $user = ['admin', 'lord'] , đồng thời phần tử đầu tiên của mảng u không phải là chữ admin.
- Thoạt nhìn thì sẽ là không thể bypass được mảng u vì nó đòi hỏi phải giống hệt nhau với mảng user, ta sẽ không dùng được cách xuống dòng, hay dấu cách, nhưng khi đưa vào Visual Code Studio, ta sẽ phát hiện được điểm bất thường:
 ![](https://i.imgur.com/meFYPXg.png)
- Mảng u để so sánh với user thực chất là mảng u được cộng thêm ký tự tàng hình, còn mảng u ta nhập vào URL là 2 mảng khác nhau. Như vậy, ta cần phải truyền vào 2 mảng, với mảng u⁠ có ký tự đặc biệt giống với mảng user, còn mảng u thường thì chỉ cần phần tử đầu không phải admin là được
- Với payload là: `https://xn--cht-8jz.vn/challenge/7/?u%E2%81%A0[0]=admin&u%E2%81%A0[1]=lord&u[0]=lord&u[1]=lord` , em có flag: 
    ![](https://i.imgur.com/HIDmzKR.png)
- Flag em có được là: `FLAG{07af425c-fc46-4689-aaf6-5512e4271f63}`

# 8. CHALLENGE 8:
- Đề bài:
    ![](https://i.imgur.com/MIzATj8.png)
    
- Challenge này yêu cầu em phải truyền vào tham số "u" sao cho sau khi URLdecode nó ra chữ 'admin', nhưng không thể truyền đi chữ 'admin' đã được encode 1 lần đi được vì khi gửi chữ 'admin' đi, bản thân trang web đã tự encode để gửi đi rồi decode để chạy, nên việc ta encode 1 lần không giải quyết được vấn đề. Nên em đã URLencode chữ 'admin' 2 lần bằng BurpSuite:
    ![](https://i.imgur.com/8Se8GSJ.png)
- Chữ 'admin' khi đã được encode 2 lần sẽ có dạng: %25%36%31%25%36%34%25%36%64%25%36%39%25%36%65. Truyền vào tham số "u" chuỗi trên em sẽ có flag: `https://xn--cht-8jz.vn/challenge/8/?u=%25%36%31%25%36%34%25%36%64%25%36%39%25%36%65`
    ![](https://i.imgur.com/22qp5XK.png)
- Flag em có được là : `FLAG{0406eb88-39ce-4dcc-bace-b058a7e57dd0}`

# 9. CHALLENGE 9:
- Đề bài:
    ![](https://i.imgur.com/TzGRdFc.png)
    
- Challenge này yêu cầu em cần nhập một chuỗi dưới 28 kí tự vào tham số "say" sao cho sau khi thực thi hàm preg_place với regex ^(.*)flag(.*)$ chuỗi vẫn còn kí tự 'give_me_the_flag'. Em đã tìm hiểu về regex qua trang https://regex101.com/ để xem cách hoạt động của các regex này là sao. 
- Thì regex "^" sẽ tìm từ đầu chuỗi, "$" sẽ tìm từ cuối chuỗi, "." sẽ match tất cả các kí tự, ngoại trừ xuống dòng, "*" sẽ match những kí tự xuất hiện từ 0 đến vô hạn lần, có thể trả về số lần xuất hiện nếu cần. Nghĩa là nếu chuỗi em có chữ flag, nó sẽ biến cả chuỗi của em thành chữ 'waf'.
- Nhưng em để ý cách lọc của regex sẽ không thực hiện nếu như em xuống dòng, cụ thể là:
     ![](https://i.imgur.com/tiOJ6Pw.png)
- Nên em đã thử xuống dòng cho chuỗi 'give_me_the_flag', kết quả nó đã không thay thế được.
    ![](https://i.imgur.com/MEDaR1o.png)
- Kết quả em chạy thử trong PhpSandbox:
     ![](https://i.imgur.com/WVqRMNs.png)
- Trong bảng URL encode, em tìm được ký hiệu xuống dòng là %0A, nên em truyền vào tham số $say=%0Agive_me_the_flag, em đã giải quyết được challenge.
- Như vậy, với payload đầy đủ: `https://xn--cht-8jz.vn/challenge/9/?say=%0Agive_me_the_flag `, em có được flag:
    ![](https://i.imgur.com/05hNQx6.png)
- Flag em có được là: `FLAG{62e0d117-93af-4e36-957c-3841d1ae7100}`
