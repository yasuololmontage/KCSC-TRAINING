# PORT SWIGGER WRITE UP: AUTHENTICATION

---
## 1. Lab: Username enumeration via different responses

![](https://i.imgur.com/KCTh2kr.png)

- Đối với lab đầu tiên này, em nhận thấy trang web này có thể tấn công bằng cách liệt kê tài khoản và mật khẩu. Lab đã chỉ ra rằng trang web có 1 tài khoảng với username và password có thể dự doán được, và nó nằm trong wordlist mà lab đã cho:
    + Candidate usernames
    + Candidate passwords
- Để xử lý lab này em đã sử dụng chức năng Intruder của BurpSuite:
    + Open Browser ở tab Proxy và thẻ HTTP history, copy link URL của lab vào browser của BurpSuite
    + Tại đây, em đã thử đăng nhập root/123456 để lấy được mẫu Intruder
    ![](https://i.imgur.com/553HQKp.png)
    + Em gửi đường dẫn trên vào URL, thực hiện brute-force với 2 đối tượng là tài khoản và mật khẩu với attack type là Cluster Bomb
    + Em nhận thấy những request trả về 200 là invalid username, nên em cần request trả về cho em 302, là cổng found, nó sẽ redirect em khi em nhập tài khoản đúng:
    ![](https://i.imgur.com/UGrc1XG.png)
    + Sau một hồi brute-force em đã có được tên đăng nhập và mật khẩu đúng
    ![](https://i.imgur.com/aYt5V9y.png)
    + Với **username là: att, mật khẩu là: qazwsx**. Em đã solve được lab này

## 2. Lab: 2FA simple bypass
![](https://i.imgur.com/hkGqK2I.png)

- Lab thứ hai này cho em 2 tài khoản, tài khoản của em và của Carlos, trang web lần này yêu cầu xác thực 2 yếu tố với yếu tố thứ 2 là một đoạn code 4 chữ số
    ![](https://i.imgur.com/o7ocbcC.png)
- Đây là mã xác thực của tài khoản chính chủ của em:
    ![](https://i.imgur.com/z2weDCG.png)
- Em đã nghĩ đến việc brute-force bài này, bởi có 4 chữ số thì em phải xử lý 10000 trường hợp, nhưng lab này không cho em làm vậy, vì khi brute-force từng chữ số nó ra status 500, còn nhập tay mới trả về status 200, không trả cho em về kết quả mong muốn, nên em đã làm cách khác.
    ![](https://i.imgur.com/JwoIQXp.png)
- Cụ thể là khi đăng nhập vào tài khoản của em, nhập được security code, em có thể thấy nó chuyển từ tab login2 chuyển sang tab my-account, nên khi đăng nhập với tài khoản Carlos, khi sang tab login2 em đã tự chuyển URL sang tab my-account, nó đã giúp em solve bài lab này khi trang web đã thực hiện việc đăng nhập thành công sang tab account của Carlos mà không cần phải nhập đoạn security code 4 chữ số.
    ![](https://i.imgur.com/f0sSDsV.png)

## 3. Lab: Password reset broken logic
![](https://i.imgur.com/4bBWFDk.png)

- Bài lab này bảo em rằng em có thể tấn công bằng phương pháp đổi mật khẩu, cụ thể là tính năng quên mật khẩu khi đăng nhập tài khoản Carlos.
- Đầu tiên khi em thử sử dụng quên mật khẩu với tên tài khoản Carlos và dùng email của chính mình: wiener@exploit-0a86003b03b39d67c10ee9c801680074.exploit-server.net thì nó vẫn gửi về email đổi mật khẩu, nhưng khi em đăng kí với username là: carlos và mật khẩu: bruh đã đổi thì nó lại báo `Invalid username or password` , sau khi em vào BurpSuite thì em mới biết em đang sửa mật khẩu nick của chính em chứ không phải nick của Carlos
    ![](https://i.imgur.com/rdOzsj3.png)
- Ở đây em thấy nó gửi đi với tên tài khoản là username của chính em và mật khẩu đã đổi trước đó, nên em đã thử đưa đường link này vào Repeater và em đã sửa đổi username ở request là Carlos:
    ![](https://i.imgur.com/2M5PJ9S.png)
- Em quan sát thấy nó đã trả về status 302, nghĩa là redirect, việc thay đổi mật khẩu cho Carlos đã thành công 
- Sau đó, em vào lại trang web proxy của BurpSuite và đăng nhập với **username là: carlos** và **mật khẩu là : bruh** thì em đã solve được lab 
    ![](https://i.imgur.com/g5umevK.png)
    
## 4. Lab: Username enumeration via subtly different responses
![](https://i.imgur.com/89Q0Btk.png)

- Bài lab này đã cho em wordlist về username và password, nên em tiến hành brute-force sử dụng tính năng Intruder của BurpSuite
- Đầu tiên đăng nhập 1 lần để lấy mẫu Intruder
    ![](https://i.imgur.com/BooGP5i.png)
- Sau đó em sử dụng 2 wordlist đã cho, bắt đầu brute-force, quan sát có thể thấy, nếu em đăng nhập sai tài khoản thì response sẽ trả về cho em status 200, nên mục tiêu của em là tìm đc tài khoản mà trả về status 302:
    ![](https://i.imgur.com/2CHf6qd.png)
- Đăng nhập với **username là: oracle và password là: buster** đã brute-force được vào trang web, em đã solve được lab:
    ![](https://i.imgur.com/Wjkqoa7.png)

## 5. Lab: Username enumeration via response timing
![](https://i.imgur.com/Z0ADisM.png)

- Bài lab này yêu cầu em brute-force tài khoản và mật khẩu dựa vào độ trễ của response, em đã đưa lab vào BurpSuite và thử một vài tài khoản và mật khẩu tuy tài khoản đúng nhưng độ trễ không chênh lệch nhau là mấy: 
    + Khi em đăng kí bằng tài khoản của mình và mật khẩu random:
        ![](https://i.imgur.com/l1azHY9.png)
    + Khi em đăng kí đúng tài khoản của mình
        ![](https://i.imgur.com/p5vu4bj.png)
    + 219ms và 209ms, không chênh lệch nhau là mấy, nhưng nếu em để mật khẩu rất dài thì lúc đấy độ trễ lại cao hơn hẳn:
    ![](https://i.imgur.com/CVcVHrG.png)
    + Độ trễ bây giờ đã lên tới tận 1788ms, nghĩa là lab này sẽ xử lý từ tài khoản rồi mới đến password, hơn nữa nếu brute-force bình thường sẽ không thể vì lab này khi em nhập sai quá nhiều trang web sẽ không cho em thử nữa. Vậy nên em đã có ý tưởng là brute-force lấy username trước, rồi mới brute-force mật khẩu.
- Ý tưởng là vậy, nhưng với việc 101 tài khoản và 100 mật khẩu khi brute-force vẫn sẽ dính phải việc nhập sai quá nhiều lần do lab này dựa vào IP để cấp số lần nhập. Em đã sử dụng `x-forwarded for header` để thay đổi header của request, với lệnh này em sẽ chỉ thẳng IP nào sẽ gửi đi tài khoản nào, cơ sở đã đủ, giờ em tiến hành brute-force lấy username. 
- Với việc brute-force lấy username, em chỉ cần xem thời gian xử lý của tk nào là dài nhất thì nó là username đúng:
    ![](https://i.imgur.com/IQJBJ4w.png)
    + Em sử dụng chế độ pitchfork và brute-force địa chỉ IP và username với mật khẩu dài
    ![](https://i.imgur.com/w2Tf2nN.png)
    + Username **announcements** có thời gian xử lý dài đột biến, nên em xác định đây là username đúng
- Khi đã có username, em tiếp tục bruteforce lấy mật khẩu, vẫn sử dụng `x-forwarded for header` để sử dụng 1 IP cho 1 lần gửi:
    ![](https://i.imgur.com/o8iS0Ov.png)
    + Lần này em sẽ xem tài khoản nào trả về status 302 là hoàn thành
    ![](https://i.imgur.com/VABxyOD.png)
- Như vậy, với username là: **announcements** và password là: **charlie**, em đã solve được lab
    ![](https://i.imgur.com/xjJqqPd.png)

## 6. Lab: Broken brute-force protection, IP block
![](https://i.imgur.com/qqV2A9x.png)

- Ở lab này thì sau khi nhập thử cũng brute-force em thấy 1 tài khoản chỉ được đăng nhập sai 3 lần, nếu sai quá số lần thì IP sẽ bị chặn và em không thể đăng nhập được nữa
- Hướng giải của bài này theo em sẽ là đăng nhập với tài khoản carlos xen kẽ với tài khoản của em, bằng việc nhập đúng tài khoản của em em sẽ không bị giới hạn số lần thử tài khoản của carlos
- Đầu tiên là tạo wordlist cho việc bruteforce
    + Username:
         ![](https://i.imgur.com/zkS6Hbd.png)
    + Password:
         ![](https://i.imgur.com/mcoBAo4.png)
- Em đã để xen kẽ tài khoản của mình với tài khoản carlos để bypass bài này, sau đó sử dụng BurpSuite Intruder tiến hành brute-force:
- Chọn attack type Pitchfork để mỗi username sẽ đi với password tương ứng:
    ![](https://i.imgur.com/JG13Hri.png)
- Kết quả sau khi brute-force đã có:
    ![](https://i.imgur.com/E3uMRA7.png)
- Với **username: carlos** và **password: 123qwe**, em đã solve được lab
    ![](https://i.imgur.com/RrafK2G.png)

## 7. Lab: Username enumeration via account lock
![](https://i.imgur.com/GP6spIL.png)

- Đầu tiền em đã thử 1 tài khoản nhiều lần nhưng kết quả trả về là `Invalid username or password` nên em nghĩ nếu tài khoản không tồn tại thì sẽ không bị khóa, nên em nghĩ đến việc brute-force mỗi tài khoản 10 lần để xem username nào bị khóa thì tài khoản đó mới là tài khoản đúng
- Để có được list username mà mỗi tài khoản lặp lại 10 lần, em đã sử dụng Python để tạo file lab6.txt với mỗi username lặp lại 10 lần.
```python=
# Mở file văn bản và đọc nội dung của file
with open("username.txt", "r") as f:
    lines = f.readlines()
# Lặp qua từng dòng trong file và nhân chuỗi của mỗi dòng
new_lines = []
for line in lines:
    new_lines.append(line.strip() + "\n" + ((line.strip() + "\n") * 9))
# Ghi nội dung đã nhân vào file
with open("lab6.txt", "w") as f:
    f.writelines(new_lines)
```
- Kết quả em có file lab6.txt như sau:
    ![](https://i.imgur.com/eTtkqGn.png)
- Tiến hành brute-force với list trên và attack type sniper:
    ![](https://i.imgur.com/i9gTy5t.png)
- Sau khi brute-force em thấy chỉ có riêng tài khoản **agenda** là trả về response bạn đã nhập sai quá nhiều nên em nghĩ đây chính là tài khoản đúng.
- Tiếp tục brute-force password với tài khoản đã có:
- Kết quả trả về có 3 loại:` Invalid username or password` , `You have made too many incorrect login attempts. Please try again in 1 minute(s)` và 1 trường hợp đặc biệt:
    ![](https://i.imgur.com/xCRRZPu.png)
- Trường hợp này không trả về dòng lỗi này nên em  nghĩ nó là mật khẩu đúng:
- Với **username: agenda , password: 654321** em đã solve được lab
    ![](https://i.imgur.com/ZWLkjLR.png)
    
## 8. Lab: 2FA broken logic
![](https://i.imgur.com/s3gGYxx.png)

- Lab trên cho em tài khoản và mật khẩu của bản thân, đồng thời tên tài khoản em cần truy cập, với kiểu bài xác thực 2 yếu tố này em nghĩ đến việc làm thế nào để bypass được phần login2, là nơi nhập code, nên em tiến hành đưa trang web vào BurpSuite để xem xét.
    ![](https://i.imgur.com/oOawa9O.png)
- Ở phần login đầu tiên, nếu em đăng nhập đúng tài khoản, web sẽ cấp cho em session và cookie verify theo tên user name, sau đó redirect sang trang login2, ở trang login2, nếu em đăng nhập đúng mfa-code thì web sẽ cấp tiếp session để redirect sang trang my-account
- Em để ý đến việc cookie: `verify=wiener` ở POST login2 nên em đã thử chuyển thành carlos nhưng không có chuyện gì xảy ra lắm
    ![](https://i.imgur.com/no2bKyG.png)
- Em hiểu rằng ở chỗ này session đang thuộc về wiener rồi, nếu chỉnh cookie ở đây sẽ không bypass được, nên em đã nghĩ ra sẽ bắt đầu đổi từ GET login2, nếu em chỉnh ở đây, web sẽ tạo mã xác thực dành cho session của tài khoản carlos:
    ![](https://i.imgur.com/8MYohXH.png)
    (GET thành công cho tài khoản carlos)
- Như vậy, mfa-code cho tài khoản carlos đã có, giờ em nghĩ em có thể brute-force mfa-code được rồi:
- Em sẽ đăng nhập vào bằng tài khoản của em, và nhập sai mã xác thực để lấy mẫu Intruder
- Tiến hành brute-force từng chữ số của đoạn mã xác thực 4 chữ số, sẽ có 10000 trường hợp
    ![](https://i.imgur.com/OISilgh.png)
- Với mã xác thực là **0031**, em đã solve được lab này:
    ![](https://i.imgur.com/5fkbwYF.png)

## 9. Lab: Brute-forcing a stay-logged-in cookie
![](https://i.imgur.com/jt0l80k.png)

- Lab này sẽ cho phép em không phải đăng nhập nếu em stay log in, chỉ cần ấn vào my account nó sẽ tự redirect đến trang chủ, nên em đã thử thay đổi username thành carlos ở POST login và brute-force nhưng không có chuyện gì xảy ra
- Em thấy cách hoạt động của trang web này sẽ là, nếu em đăng nhập thành công và bật stay log in, trang web sẽ cấp cho em 1 cookie là stay-logged-in, cụ thể là:
    ![](https://i.imgur.com/xW5rFqE.png)
- Nếu em có vào lần sau thì trang web sẽ so sánh xem cookie stay-logged-in và session có giống không, nếu có em sẽ vào thẳng trang web mà không cần phải đăng nhập
    ![](https://i.imgur.com/pd9qw2L.png)
- Em để ý rằng đoạn cookie stay-logged-in này có thể là base64 encode, nên em đã thử:
    ![](https://i.imgur.com/uRzeZKN.png)
- Quá bất ngờ, cookie này lại là username và 1 đoạn mã 32 ký tự nhìn khá đáng ngờ, vì em biết có 1 loại encrypt là md5 hash hay dùng cho mật khẩu cũng cho ra output là string 32 character, nên em đã thử tiếp: 
    ![](https://i.imgur.com/K8Dd4j0.png)
- Dòng ký tự kia hóa ra lại là mật khẩu của em, vậy nghĩa là cookie stay-logged-in được cấu tạo từ 2 phần: **base64encode(username:(md5hash(password)))**
- Để kiểm chứng xem suy đoán của em có đúng hay không, em sẽ log out rồi thử brute-force ở tab GET /my-account sử dụng cấu trúc trên,chỉ cần có 1 trang web nào trả về cho em respond trang chủ thì nghĩa là em đã đúng:
    ![](https://i.imgur.com/4oRi9X4.png)
- Em brute-force password với list password có thêm chữ peter và các điều kiện:
>     + Hash: MD5
>     + Add Prefix: wiener:
>     + Base64-encode
**=>** Với những điều kiện này, password của em sẽ được hash md5 trước, rồi thêm chữ `wiener:` vào đằng trước và cuối cùng được base64-encode
    ![](https://i.imgur.com/lYkLpAM.png)
- Kết quả đã có, chỉ ở payload cuối cùng là chữ peter em thêm vào, thì nó không redirect về trang login, mà nó đã có sẵn trang chủ: 
    ![](https://i.imgur.com/jrigPAH.png)
- Như vậy suy đoán của em đã đúng, em có thể thay đổi tab Intruder này với wordlist mật khẩu và prefix thay đổi thành `carlos:`
    ![](https://i.imgur.com/FfSpu41.png)
    ![](https://i.imgur.com/YOSQKkk.png)
- Em đã solve được lab này bằng cookie **stay-logged-in:Y2FybG9zOmRmMDM0OWNlMTEwYjY5ZjAzYjRkZWY4MDEyYWU0OTcw**, hay là **username: carlos, password: hockey**
    ![](https://i.imgur.com/J8xDS7D.png)

## 10. Lab: Offline password cracking
![](https://i.imgur.com/ffVTPLC.png)
