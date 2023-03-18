# TRYHACKME: LINUX WALKTHROUGH

---

## Linux Fundamentals Part 1
### Mở đầu: 
- Linux là một hệ điều hành mã nguồn mở miễn phí được công bố vào năm 1991, nó là một hệ điều hành rất mạnh, và nhẹ hơn Windows rất nhiều nên bạn chắc chắn đã từng dùng một trong các ứng dụng của Linux trong đời sống, chẳng hạn như:
    + Website
    + Máy chủ
    + Phần mềm xử lý thanh toán khi mua hàng
    + Đèn giao thông,...
- Linux cho phép người dùng tùy chỉnh theo nhu cầu của họ, nên có rất nhiều phiên bản Linux. Ubuntu & Debian là những phiên bản phổ biến của Linux vì nó có thêm những tính năng thuận tiện cho người dùng
- Tuy nhiên, cái gì cũng có mặt lợi và mặt hại, điểm yếu của Linux mà đa số người dùng Windows đã quen là Linux thường không có GUI(Graphic User Interface), hay là màn hình desktop. Đa số chúng ta sẽ hoạt động với các câu lệnh thực hiện ở trong terminal chứ không phải những thao tác hiện ra cho chúng ta lựa chọn như ở Windows.
### Ban đầu, việc làm mọi thứ ở terminal sẽ khá khó khăn do ta chưa làm quen với việc này, nhưng khi quen ta sẽ thấy nó rất tiện và nhanh hơn so với việc thao tác trên desktop
- Đến với những câu lệnh đầu tiên được sử dụng trong cmd, ta có `echo`, câu lệnh echo sẽ đưa ra bất kỳ chữ gì mà chúng ta nhập vào sau đó.
    + Ví dụ: ![](https://i.imgur.com/P6NtZkm.png)
    + Chú ý: Nếu chuỗi ký tự ta muốn hiện ra ngoài không xuất hiện dấu cách, ta không cần phải có dấu ngoặc kép `""` ở hai đầu chuỗi.
    + Câu lệnh echo là một trong những câu lệnh khá hữu dụng trong việc debugging, để xem code của chúng ta đã chạy đến dòng nào từ đó khắc phục bug, nó cũng có thể dùng để chạy giữa các command để nối chúng lại với nhau.
- Tiếp theo là câu lệnh `whoami`, câu lệnh này cho ta biết tên user là đăng nhập vào Linux
    + Ví dụ: ![](https://i.imgur.com/li1hb12.png)
### Chỉ với hai câu lệnh trên là chưa đủ nên ta sẽ tiếp cận với những câu lệnh mà dùng cho việc tương tác với file như: xem, đọc và chỉnh sửa file mà không cần phải nhấn vào file đó ở desktop (nghe ngầu vl)
- Các câu lệnh hoạt động với file cơ bản có thể kể đến:


| Câu Lệnh | Viết Tắt của | Ý nghĩa |
| -------- | -------- | -------- |
|ls|listing|liệt kê ra những thư viện hay thư mục của file đó|
|cd|change directory|chuyển đến thư mục hay thư viện chỉ định, khi đó cmd sẽ có địa chỉ của thư viện đó, trong thư viện ta có thể sử dụng các câu lệnh khác|
|cat|concentrate|xem nội dung của file, có thể thực hiện với cả file binary tuy nhiên cat nên dùng cho file text|
|pwd|print working directory| đưa ra đường dẫn tuyệt đối đến với thư viện mà ta đang làm việc|
- Tips cho các câu lệnh:
    + Chúng ta có thể xem có những thư viện hay file gì có trong thư viện mà không cần nhấn vào đó bằng cách: ls + Filename. Ví dụ: `ls MyDocuments`
    ![](https://i.imgur.com/PXyZvBT.png)
    + Chúng ta có thể quay về thư mục trước sau khi sử dụng lệnh cd bằng cách `cd ..`
    ![](https://i.imgur.com/9wOozLU.png)
    + Ta có thể clear terminal bằng Ctrl L
    + Chúng ta có thể xem được nội dung của file mà không cần phải cd hay chuyển hướng sang file đã có bằng việc `cat + Đường dẫn tuyệt đối đến file`. Ví dụ: cat /home/ubuntu/Documents/todo.txt
    ![](https://i.imgur.com/E13FjfK.png)
- Với những câu lệnh như trên, ta có thể thấy Linux sẽ dễ sử dụng với những người đã quen với nó, và có vẻ nó không hề dễ sử dụng cho người mới, nhưng khi đã quen với việc này thì Linux sẽ hiệu quả và tiện hơn rất nhiều, đặc biệt là với những câu lệnh tìm kiếm file nhanh và hiệu quả hơn, ta không cần thiết phải `ls` và `cd` liên tục.
### Những câu lệnh tìm kiếm file hiệu quả:
- Câu lệnh `find`:
    + Find là câu lệnh rất mạnh, nó dễ hiểu hay phức tạp tùy thuộc vào các thức sử dụng của chúng ta. Câu lệnh `find` cho phép tìm kiếm file theo tên hoặc theo dạng file mà không cần phải cd và ls từng folder.
    + Giả sử, ta cần phải tìm file note.txt trong máy, ta có thể sử dụng: `find -name note.txt`, khi đó nó sẽ trả về đường dẫn tuyệt đối đến với file txt đó:
    ![](https://i.imgur.com/ECKJE9g.png)
    + Giờ nếu ta không biết tên của file txt đó, ta có thể dùng câu lệnh find để tìm ra tất cả file txt có trong máy như: `find -name *.txt`, khi đó cmd sẽ trả về đường dẫn tuyệt đối đến những file txt có trong máy
    ![](https://i.imgur.com/SDFsYK5.png)
- Câu lệnh `Grep`:
    + Câu lệnh Grep sẽ cho phép chúng ta tìm kiếm nội dung cụ thể mà chúng ta muốn có ở trong file.
    + Công dụng của câu lệnh này khá giống với Ctrl F trong trang web hay word, excel của Windows. Cách dùng của câu lệnh Grep như sau: grep + "Nội dung muốn tìm" + "Tên File"
    + Ví dụ: `grep "THM" access.log` -> Câu lệnh trên sẽ tìm kiếm trong file và trả về entry nào có ký tự "THM"
    ![](https://i.imgur.com/5s2yMeI.png)
### Sơ lược về Linux Operators:
- Operator `&`: operator này cho phép ta chạy câu lệnh này ngầm trong khi thực hiện các câu lệnh khác, chẳng hạn copy một file lớn,...
- Operator `&&`: operator này sẽ được sử dụng khi ta muốn thực thi câu lệnh thứ 2 sau khi câu lệnh thứ nhất đã được thực thi thành công. Nếu ta muốn thực thi 3,4,5,... câu lệnh thì cũng được thôi, ta chỉ cần nối các câu lệnh với nhau bằng `&&` và điều kiện là câu lệnh trước phải thực thi được thì câu lệnh sau mới được thực thi. Operatẻ này rất hữu dụng nếu ta cần phải thực thi những câu lệnh dài hoặc không muốn chạy câu lệnh thứ 2 nếu câu lệnh đầu thất bại
    ![](https://i.imgur.com/V2oqMpS.png)
- Operator `>`: operator này cho phép ta chuyển output của một command ta thực thi sang một nơi khác, có thể là một file, một thư viện,...
    + Ví dụ: Ta muốn hiện chữ hello vào một file txt là welcome, thì ta sẽ thực hiện như sau: 

        ![](https://i.imgur.com/rybGbL8.png)
- Operator `>>`: Công dụng của operator này khá tương đồng với `>`, tuy nhiên thay vì ghi đè lên file thì `>>` sẽ ghi tiếp vào cuối file:
    ![](https://i.imgur.com/GrNstsZ.png)

## Linux Fundamentals Part 2
- Đến với vần tiếp theo, chúng ta sẽ được giới thiệu cách để dăng nhập vào một máy Linux từ xa sử dụng SSH, tối ưu những câu lệnh và một số câu lệnh tương tác với file.
### Sơ lược về SSH, cách truy cập vào Linux sử dụng SSH
- Secure Shell, viết tắt là SSH là một phương thức giữa các thiết bị dưới dạng mã hóa. Sử dụng các thuật toán, những input mà chúng ta đưa vào sẽ bị mã hóa trước khi đưa lên mạng, xong chúng được giải mã khi đến được máy từ xa.
- Ví dụ:![](https://i.imgur.com/XDYLImX.png)
- Có nhiều thuật toán để mã hóa thông tin trong SSH, nhưng hiện tại có 2 thứ chúng ta cần biết:
    + SSH cho phép ta thực hiện được câu lệnh trên một máy tính khác từ xa.
    + Bất kỳ dữ liệu nào giữa các thiết bị đều sẽ bị mã hóa khi chúng được gửi qua mạng, ví dụ như Internet.
- Nói nôm na, SSH sẽ giúp ta điều khiển máy linux của người khác sử dụng máy linux của bản thân.
- Cách sử dụng SSH để truy cập vào máy Linux:
    + Địa chỉ IP của máy tính cần truy cập
    + Thông tin đúng về tài khoản dùng để đăng nhập trên máy tính từ xa(username, password)
    + Cách sử dụng: **ssh** `username` **@** `địa chỉ IP`
    + Ví dụ: ![](https://i.imgur.com/9MXMNxR.png)
    + Ở đây, sau khi truy cập vào máy Linux, ta cần nhập mật khẩu của máy tính từ xa kia, lưu ý rằng mật khẩu sẽ không hiện trên cmd nên ta chỉ cần nhập và enter là thành công
    + Như ví dụ này là việc truy cập đã thành công, từ giờ tất cả những câu lệnh ở trên máy chúng ta sẽ được thực hiện ở trong máy từ xa.

### Giới thiệu về flag và switches
- Đại đa số câu lệnh đều cho phép ta cung cấp thêm các đối số(arguments), những đối số này thường được biểu diễn bằng gạch nối và các keyword cụ thể được biết đến là flags và switches.
    + Flags là các tùy chọn ngắn hơn, thường được đặt trước 1 ký tự gạch (-). Ví dụ: -h, -v, -c,... Nếu có nhiều flags cùng xuất hiện, thì chúng có thể được kết hợp lại thành một ký tự duy nhất. Ví dụ: ls -la, trong đó flag -l sẽ hiển thị thông tin chi tiết, còn flag -a sẽ hiển thị cả các file ẩn.
    + Switches là các tùy chọn dài hơn, thường được đặt trước 2 ký tự gạch (--). Ví dụ: --help, --version, --force,... Switches thường là các tùy chọn phức tạp hơn, cho phép cấu hình nhiều thông số hơn so với các flags.
- Khi ta thực hiện câu lệnh, ngoại trừ khi chúng thực sự cụ thể, nếu không truyền vào đối số chúng sẽ thực thi theo kiểu mặc định.
- Ví dụ như câu lệnh: `ls`. Câu lệnh này sẽ liệt kê ra nhưng thư mục ở trong thư viện chúng ta đang truy cập đến, tuy nhiên, nhưng thư mục ẩn thì sẽ không được liệt kê, ta có thể sử dụng flag và switch để xem được những thư mục kiểu đó: 
    ![](https://i.imgur.com/MGcow8Q.png)
    + Chỉ cần sử dụng thêm ký tự `-a`(viết tắt của `--all`), ta sẽ thấy được rất nhiều file đã bị ẩn đi được liệt kê như trên ảnh.
    + Nếu ta không biết hết những flag và switch của 1 câu lệnh thì ta có thể sử dụng `--help`
    ![](https://i.imgur.com/qK0i8yQ.png)
- Thật ra, option này là output của Man page, viết tắt của Manual Page, là nơi chứa thông tin và tài liệu về câu lệnh trong Linux và ứng dụng.
- Manual page(Man page) là nguồn thông tin hữu dụng cho việc tìm kiếm thông tin về câu lệnh và ứng dụng, ta có thể truy cập Man page ngay chính trong máy Linux hoặc trên mạng
- Để truy cập vào trang tài liệu, ta sử dụng : **man** `câu lệnh cần dùng`. Ví dụ: `man ls`
    ![](https://i.imgur.com/Odop9Hk.png)

### Tiếp tục với những câu lệnh tương tác với file 
- Ở phần trước chúng ta đã được tiếp cận với những câu lệnh cơ bản trong việc tương tác với file như: cat, ls, cd, find
- Để tiếp tục, ta sẽ học đến những câu lệnh với những chức năng như: tạo, di chuyển và xóa file/ thư mục.
- Danh sách những câu lệnh:

| Câu lệnh | Tên đầy đủ | Mục đích |Cách sử dụng|
| -------- | -------- | -------- |--------|
| touch | touch   | Tạo 1 file| **touch** `tên file`|
|mkdir|make directory| Tạo 1 thư viện| **mkdir** `tên thư mục`|
|cp|copy|Sao chép 1 file hoặc 1 thư mục|**cp** `tên file cần copy` `tên file được copy sang`|
|mv|move|Di chuyển 1 file hoặc 1 thư mục|**mv** `tên file cần di chuyển` `tên file được di chuyển sang` |
|rm|remove|Xóa 1 file hoặc 1 thư mục|**rm** `tên file` hoặc **rm -R** `tên thư viện` |
|file|file|Biết được loại file của 1 file|**file** `tên file`|
- Những lưu ý cần biết:
    + Khi remove 1 folder, ta cần phải thêm đối số `-R`
    ![](https://i.imgur.com/dfRW21l.png)    
    + Câu lệnh cp sẽ lấy toàn bộ nội dung của file cần copy và đưa sang file mới là file được copy sang, còn câu lệnh mv sẽ điều chỉnh và hợp lại file cần di chuyển sao cho phù hợp với những đối số ta đưa vào. Không những thế, câu lệnh mv còn có thể đổi tên của file và folder cần di chuyển.
    ![](https://i.imgur.com/Faa9VHI.png)

### Quyền Truy Cập 
- Như chúng ta đã biết, user chỉ có thể có những quyền nhất định với những file mà họ có. Chắc bạn cũng đã từng gặp những file bấm vào nhưng không ra cái gì, đó là vì bạn không có quyền thực thi chúng. 
- Một file cơ bản sẽ có những quyền sau:
    + Đọc
    + Viết
    + Thực thi
- Ví dụ: ![](https://i.imgur.com/6o5nBZQ.png)
    + Ở đây chúng ta thấy `-rw`, nghĩa là chúng ta chỉ có thể đọc(read) và viết(write) file mà không thể thực thi.
- Một điều rất thú vị của Linux nếu user sở hữu và đặt quyền cho file, một nhóm các user khác có thể có những quyền khác với những quyền và user sở hữu đã cài đặt mà không làm ảnh hưởng đến file gốc.
- Cách chuyển sang user khác sử dụng **su**:
    + **su** `tên user`
    + Sau đó nhập password
- `su` cũng có những đối số có thể truyền vào mà có thể bạn đã biết, ví dụ như: `-1`,`--login`
- Nếu bạn chỉ dùng `su` không, thì khi đăng nhập thành công nó sẽ đưa bạn đến trang home của user trước khi `su`, còn nếu bạn sử dụng thêm `su -1` cmd sẽ đưa bạn đến trang home của user hiện tại:
    ![](https://i.imgur.com/QLfCP5O.png)

### Những Thư Viện Phổ Biến:

- **/etc**: Đây là một trong những thư mục quan trọng quan trọng nhất của các thư viện root trong hệ thống. Thư mục etc(viết tắt của etcetera) là một thư mục dùng để lưu trữ những file hệ thống và được sử dụng bởi hệ thống khởi động của máy.

- **/var**: viết tắt của variable data, thư viện này là một trong những thư mục nguồn chính trong file cài đặt Linux. Thư mục var sẽ chưa những dữ liệu thường được truy cập và sử dụng bởi những ứng dụng hoặc dịch vụ của hệ thống. Ví dụ: những file log của việc chạy các dịch vụ và ứng dụng được viết trong /var/log

- **/root**: thư mục /root chính là thư mục /home cho người sử dụng hệ thống nguồn, một người dùng thường mặc định sẽ có data ở trong thư mục: /home/root

- **/tmp**: đây là thư mục độc đáo có trong file cài đặt Linux. Viết tắt của temporary, những dữ liệu có trong thư mục tmp thường là những dữ liệu chỉ cần truy cập 1 đến 2 lần, một khi máy khởi động lại thì dữ liệu trong thư mục này sẽ biến mất.
    + Một điều rất có lợi cho việc pentest là bất kỳ user nào cũng có thể viết vào file này, nên nó là nơi để viết script khá tốt.

## Linux Fundamentals Part 3
- Đến với phần tiếp theo này, ta sẽ được giới thiệu những công cụ và ứng dụng mà chúng ta rất có thể sẽ sử dụng hàng ngày. Đồng thời ta cũng được tối ưu hơn kĩ năng Linux bằng việt học về tự động hóa, quản lý các gói tin, và đăng nhập dịch vụ hoặc ứng dụng.
### Công cụ chỉnh sửa file text trong Terminal
- Trong những phần trước, ta đã học cách viết thêm output kiểu text vào 1 file bằng cách sử dụng echo và operator `>` hoặc `>>`. Tuy nhiên nó không phải là một cách hiệu quả nếu ta gặp phải dữ liệu lớn như là 1 file với nhiều dòng và nhiều loại.
- Có rất nhiều công cụ chỉnh sửa file text, nhưng ở đây ta sẽ được giới thiệu 2 công cụ chính là **nano** và **VIM**
- **nano** là một thứ rất dễ dàng để làm quen và sử dụng, để sử dụng nano, ta chỉ cần nhập: **nano** `tên file cần edit`
    + Sau khi nhập, màn hình giao diện sẽ hiện ra và chúng ta có thể chỉnh sửa, thêm, xóa text và các chức năng khác ![](https://i.imgur.com/BbqjaLN.png)
    + Ở trong Linux các chức năng Ctrl được thể hiện là dấu `^`, nên như giao diện, các chức năng có thể kể đến như:
        + Tìm chữ
        + Copy và dán
        + Nhảy đến một dòng theo số dòng
        + Xem số dòng hiện tại mình đang ở
    + Để thoát, ta ấn Ctrl X
- **VIM** là một công cụ chỉnh sửa text nâng cao hơn rất nhiều. Khá là khó để có thể hiểu biết hết được các chức năng cao cấp của VIM nhưng việc được giới thiệu cũng sẽ giúp bạn cải thiện về kỹ năng sử dụng Linux của mình:
    ![](https://i.imgur.com/OqV7avc.png)
    + Các chức năng nâng cao của VIM có thể kể đến:
        + Tùy chỉnh keybind theo ý thích
        + Nổi bật cú pháp: giúp hiện thị các văn bản code dễ dàng nhận diện và sử dụng hơn
        + VIM hoạt động ở mọi terminal trong khi nano có thể có những cmd không install được
        + Gồm nhiều tài liệu hướng dẫn, tư liệu tham khảo bạn có thể tìm kiếm và đọc chúng
    + Tuy nhiên, các chức năng của VIM khá là tốn gian cho việc làm quen
### Những công cụ hữu dụng 
- Tải file: Để thực hiện việc tải file, ta sử dụng câu lệnh `wget`. Câu lệnh trên cho phép ta tải file từ trên trang web, cách sử dụng rất đơn giản: **wget** `URL của file cần tải`.
    + Ví dụ: `wget https://assets.tryhackme.com/additional/linux-fundamentals/part3/myfile.txt`

- Chuyển file từ host - SCP (SSH):
    + Secure Copy(SCP) khác với lệnh cp ở chỗ, bạn có thể chuyển file từ máy này sang máy khác sử dụng SSH. Cụ thể là SCP cho phép bạn chuyển file từ máy bạn sang máy khác, và từ máy khác sang máy bạn
    + Bạn phải biết username và password của máy từ xa để thực thi được câu lệnh này
    + Ví dụ: Ta cần copy file important.txt từ máy của mình sang máy từ xa, thì cấu trúc của câu lệnh scp sẽ có:
        + **scp** `tên file muốn chuyển` `username của máy từ xa`**@**`Địa chỉ IP của máy từ xa`**:**`đường dẫn đến với chỗ mà file được chuyển sang`
        + Câu lệnh đầy đủ được thực hiện sẽ là: `scp important.txt ubuntu@192.168.1.30:/home/ubuntu/transferred.txt`
    + Một ví dụ khác: Ta muốn copy file important.txt từ máy từ xa mà ta chưa đăng nhập vào về máy của mình, thì cấu trúc của cậu lệnh scp sẽ là:
        + **scp** `username của máy từ xa`**@**`Địa chỉ IP của máy từ xa`**:**`đường dẫn đến file cần được chuyển` `tên file sau khi chuyển sang máy mình`
        + Câu lệnh đầy đủ được thực hiện sẽ là: `scp ubuntu@192.168.1.30:/home/ubuntu/documents.txt notes.txt `

- Đưa file từ host thông qua WEB:
    + Mỗi máy Linux sẽ được cài sẵn python3. Python là công cụ rất mạnh cho phép ta tạo một HTTPServer nhẹ và dễ sử dụng, câu lệnh này sẽ giúp ta đẩy file lên HTTPServer để những máy khác có thể tải được những file đó sử dụng `wget` hoặc `curl`
    + Python3 HTTPServer sẽ đẩy những file có trong thư viện mà bạn đang thực thi câu lệnh này lên trên WEB, cụ thể bạn chỉ cần chạy câu lệnh: `python3 -m  http.server` để bắt đầu chạy mô hình này
    ![](https://i.imgur.com/wolVA4a.png)
    + Với câu lệnh này thì những file ở trong thư mục tmp sẽ được đẩy lên trang web này, và ta có thể tải chúng bằng câu lệnh `wget`
    ![](https://i.imgur.com/P7zxe0I.png)
    + Tuy nhiên, với câu lệnh này thì ta cần phải biết chính xác tên và địa chỉ của trang web mà mình sẽ lưu vào khi tải về 
    + Với ảnh trên thì việc tải file đã thành công, và nó đã được lưu vào log của server:
    ![](https://i.imgur.com/Uc6kZEA.png)
    + Cuối cùng, ta có thể Ctrl C để dừng Python3 HTTPServer.

### Giới thiệu về Processes
- Processes là những chương trình đang chạy ở máy của bạn. Chúng được quản lý bởi một kênh, và mỗi process sẽ có một ID gắn với nó, còn được biết đến là PID. PID sẽ gia tăng theo số thứ tự mà process ấy bắt đầu.
- Để xem các process ta có thể sử dụng câu lệnh: `ps`. Câu lệnh này đưa ra danh sách các process đang chạy như session của người dùng và các thông tin khác như thông tin trạng thái, thời gian sử dụng của CPU, và tên thật của chương trình đang được thực thi.
- Để có thể xem được process của các user khác và các process từ các session khác nhau, ta sử dụng `ps aux`
    ![](https://i.imgur.com/DWJTEzu.png)
- Một câu lệnh hiệu quả nữa là `top`, top đưa cho bạn danh sách những process đang chạy theo thời gian thực và sẽ refresh mỗi 10 giây, hoặc khi bạn dùng mũi tên để di chuyển giữa các hàng
    ![](https://i.imgur.com/Gg2mLia.png)
- Ta cũng có thể dừng một process bằng lệnh **kill** `PID của process`. Ví dụ: `kill 9999` 
    + Một số tín hiệu chúng ta có thể gửi đến một process nếu nó bị dừng:
        + SIGTERM: dừng process, nhưng để cho nó dọn dẹp trước
        + SIGKILL: dừng process, không dọn dẹp gì cả
        + SIGSTOP: dừng và đình chỉ process đấy
- Khởi động Process hoặc Dịch vụ ngay từ lúc khởi động máy: 
    + Có một vài ứng dụng có thể chúng ta sẽ cần chạy ngay khi máy được khởi động, ví dụ như web server, database server, game server,...
    + Ta có thể tự tạo một server và cài đặt nó chạy khi máy tính của bạn khởi động Linux bằng `systemctl`, cú pháp sẽ là `systemctl [option] [service]`
    + Các option có thể có là: start, stop, enable, disable
    + Ví dụ như để tạo lập 1 server apache và server sẽ chạy khi máy tính khởi động: `systemctl start apache2`
- Thay vì dùng operator `&` để chạy ngầm cho một câu lệnh, ta có thể dùng Ctrl Z để dừng câu lệnh đang chạy và chạy ngầm. Nếu bạn muốn câu lệnh ấy tiếp tục hiển thị trên cmd thì có thẻ dùng lệnh `fg`

### Cách bảo trì hệ thống: Tự động hóa
- Người dùng có thể sẽ muốn đặt lịch trình cho một hành động cụ thể sẽ xảy ra sau khi mà máy đã được bật, chẳng hạn là bật Spotify 10 phút sau khi hệ thống được khởi động,... 
- Chúng ta sẽ đến với câu lệnh `cron` và cách mà chúng ta có thể tương tác với nó thông qua việc sử dụng `crontabs`. Crontab là một trong những quy trình được bắt đầu trong khi khởi động, chịu trách nhiệm tạo điều kiện và quản lý các công việc định kỳ.
- Một crontab là một tệp đặc biệt được định dạng để câu lệnh `cron` có thể thực thi từng dòng một. Một crontabs yêu cầu 6 giá trị cụ thể:
    
| Giá trị | Mô tả |
| -------- | -------- |
| MIN     | Thực hiện vào phút nào     |
|HOUR|Thực hiện vào giờ nào|
|DOM| Thực hiện vào ngày nào trong thángƯ
|MON|Thực hiện vào tháng mấy trong năm|
|DOW|Ngày nào trong tuần để thực hiện tại|
|CMD|Lệnh nào sẽ được thực thi|

- Với những giá trị nào nằm trong yêu cầu bạn muốn đặt, ví dụ như tôi muốn sau 12h sẽ backup 1 file, thì những giá trị còn lại ta sẽ đặt là dấu `*`
- Crontabs cũng có thể được chỉnh sửa bằng câu lệnh: `crontab -e`, nơi bạn có thể sử dụng phần mềm chỉnh sửa như nano để sửa crontabs. 

### Cách bảo trì hệ thống: Quản lý gói tin
- Khi nhà phát triển muốn gửi phần mềm đến với cộng đồng, thì họ phải gửi lên một kho lưu trữ tên là "apt", nếu được chấp thuận thì các chương trình hoặc công cụ của họ sẽ được release. Vì vậy Linux rất đáng giá với 2 tính năng: khả năng truy cập và sự phong phú của các công cụ nguồn mở.
- Quản lý kho lưu trữ của bản thân:
    + Thông thường, ta sử dụng lệnh `apt` để cài đặt phần mềm vào Ubuntu. Lệnh apt là một phần của phần mềm quản lý gói cũng có tên là apt. Apt chứa toàn bộ bộ công cụ cho phép quản lý các gói và phần mềm, đồng thời cài đặt hoặc gỡ bỏ phần mềm.
    ![](https://i.imgur.com/UCPZ7t4.png)
    + Ta có thể thêm kho lưu trữ bằng câu lệnh `add-apt-repository` 
    + Tuy nhiên, ta sẽ học cách thêm và xóa kho lưu trữ theo cách thủ công, mặc dù bạn có thể cài đặt phần mềm thông qua việc sử dụng các trình cài đặt gói chẳng hạn như `dpkg`. Nhưng lợi ích của việc cài đặt thủ công là khi bạn update hệ thống, kho lưu trữ chứa phần mêm cũng sẽ được cập nhật.
    + Đầu tiên để tải một phần mềm ở trên mạng về, bạn có thể sử dụng câu lệnh `wget`,rồi tạo file phần mềm trong apt, sau đó là `sudo apt update` để update kho lưu trữ bạn vừa thêm vào, rồi `sudo install` để cài đặt
    + Nếu muốn xóa thì ta chỉ cần sử dụng câu lệnh:`add-apt-repository --remove ppa:PPA_Name/ppa` hoặc xóa thủ công tệp mà chúng ta đã thêm trước đó. Sau khi xóa, ta có thể dùng `apt remove [tên phần mềm]`

### Cách bảo trì hệ thống: Logs
- File logs chứa trong /var/log là file chứa thông tin ghi log của các ứng dụng và dịch vụ đang chạy trên hệ thống của bạn
- File logs là cách rất tốt để kiểm tra tình trạng hệ thống cũng như bảo vệ nó. Không những thế, logs của một web server có chứa thông tin của từng yêu cầu, cho phép nhà phát triển hay người quản trị phát hiện hành vi xâm nhập vào trang web. 
- Có 2 loại log đáng chú ý: access log và error log
     ![](https://i.imgur.com/j9E8S89.png)
- Ta cũng có những log lưu lại thông tin của hệ thống khởi động đang chạy và các hành động của user, như là số lần thử xác thực.



# TRYHACKME: NETWORKING WALKTHROUGH
---

## Giới thiệu:
- Bài biết này sẽ cung cấp bạn những thông tin cơ bản nhất về những nguyên tắc cơ bản của Mạng Máy Tính. Mạng Máy Tính là một chủ đề rất rộng, vì vậy đây chỉ là một bản tóm lược vắn tắt. Tuy nhiên mong rằng nó vẫn sẽ cho bạn đủ những kiến thức nền tảng của chủ đề này, từ đó có thể tự xây dựng được một mô hình mạng.
- Những chủ đề ma bài viết này sẽ đề cập đến:
    + Mô hình OSI
    + Mô hình TCP/IP
    + Các mô hình mạng trong thực tế
    + Giới thiệu sơ lược về những công cụ trong Mạng Máy Tính

## Tổng Quan về mô hình OSI
- Mô hình OSI (**O**pen **S**ystems **I**nterconnection) là mô hình được chuẩn hóa được dùng để biểu diễn lý thuyết đằng sau mạng máy tính. Thực sự rằng trong thực tế mô hình TCP/IP gọn nhẹ hơn, nhưng về nhiều mặt thì mô hình OSI ưu việt và dễ hiểu hơn khá nhiều
- Mô hình OSI gồm 7 tầng khác nhau:

| OSI | Tầng | Tên dữ liệu được sử dụng ở tầng đó |
| -------- | -------- | -------- |
|Application|Tầng Ứng dụng|Data|
|Presentation|Tầng Trình Bày|Data|
|Session|Tầng Phiên|Data|
|Transport|Tầng Vận Chuyển|Datagram, Segment|
|Network|Tầng Mạng|Packet|
|Data link|Tầng Liên Kết|Frame|
|Physical|Tầng Vật Lý|Bit|
- Một số ví dụ trực quan về mô hình OSI:
    ![](https://i.imgur.com/ZHjaAMU.png)
- Ta sẽ đi sâu vào từng tầng, với các chức năng chính của chúng:
- Tầng 7, Application:
    + Về cơ bản thì chức năng chính là: cung cấp các tùy chọn kết nối mạng cho các chương trình chạy trên máy tính. 
    + Nó cung cấp giao diện cho chúng sử dụng để truyền dữ liệu. Khi dữ liệu được cung cấp cho lớp ứng dụng, nó sẽ được chuyển xuống lớp trình bày.
- Tầng 6, Presentaion:
    + Tầng trình bày sẽ nhận dữ liệu từ tầng ứng dụng, sau đó dịch dữ liệu sang dạng chuẩn hóa, cũng như xử lý các dạng mã hóa, nén hay các biến đổi kiểu khác đối với dữ liệu.
    + Sau khi hoàn tất biến đổi, dữ liệu được gửi xuống tầng phiên
- Tầng 5, Session:
    + Sau khi đã nhận đúng dạng, tầng phiên sẽ xem xét liệu nó có thể kết nối với các máy khác thông qua mạng không, nếu không nó sẽ báo về lỗi và kết thúc chu trình. Nếu như một phiên được thiết lập thì nhiệm vụ của tầng phiên là duy trì nó, cũng như kết hợp với tầng phiên của các máy từ xa để đồng bộ hóa liên lạc. 
    + Tầng phiên đặc biệt quan trọng vì phiên mà nó tạo ra là duy nhất cho giao tiếp được đề cập, đây là thứ cốt lõi giúp ta có thể gửi nhiều yêu cầu đến các điểm cuối khác nhau mà không làm xáo trộn dữ liệu(mở 2 tab cùng 1 lúc)
    + Nếu phiên được thiết lập thành công, nó được chuyển xuống tầng vận chuyển.
- Tầng 4, Transport:
    + Tầng vận chuyển là tầng vô cùng quan trọng, đây là nơi xử lý rất nhiều chức năng quan trọng.
    + Chức năng đầu tiên là quyết định xem sẽ vận chuyện file theo giao thức nào: Hai giao thức phổ biến nhất trong truyền file là **TCP** (Transsmission Control Protocol) và **UDP** (User Datagram Protocol)
        + Với TCP: truyền dữ liệu dựa trên kết nối, nghĩa là kết nối giữa các máy tính được thiết lập và duy trì trong suốt thời gian yêu cầu, vậy nên đây là phép truyền đáng tin, vì nó có thể đảm bảo rằng tất cả các gói đến đúng nơi, nếu dữ liệu bị mất sẽ được gửi lại
        + Với UDP: ngược lại với TCP, các gói dữ liệu về cơ bản được ném vào máy tính nhận - nếu nó không thể theo kịp thì đó là vấn đề của nó (đây là lý do tại sao truyền video qua thứ gì đó như Skype có thể bị pixel nếu kết nối kém)
        + Vậy nên, ta ưu tiên sử dụng TCP khi cần độ chính xác(truyền file hoặc tệp thông tin) và UDP khi cần tốc độ truyền(truyền phát video)
    + Tùy những giao thức vừa chọn, tầng giao vận sẽ chia các làn truyền thành những mảnh nhỏ (với TCP thì ta gọi là các *segments*, với UDP ta gọi là các *datagrams*)
- Tầng 3, Network:
    + Tầng mạng sẽ chịu trách nhiệm xác định điểm đến của yêu cầu, từ đó xác định địa chỉ IP đích, cũng như định tuyến(routing) để tìm được đường đi tốt nhất cho các gói tin. 
    + Ở tầng này ta làm việc với địa chỉ logic(địa chỉ IP), mục đích ta sử dụng địa chỉ logic để phân thứ tự, phân loại, nhận biết và giúp ta có thể sắp xếp chúng. Loại địa chỉ logic được dùng phổ biến hiện nay là IPv4. Ví dụ như: 192.168.1.1 (địa chỉ router wifi nhà bạn)
- Tầng 2, Data Link:
    + Tầng liên kết này sẽ chú trọng đến địa chỉ vật lý(MAC) của quá trình truyền gói tin. Sau khi nhận được packet từ tầng mạng (bao gồm địa chỉ IP của máy từ xa), tầng liên kết sẽ thêm địa chỉ MAC vào cuối của điểm nhận. Trong mỗi máy tính được kết nối mạng đều có Card giao diện mạng (NIC), đi kèm là địa chỉ vật lý duy nhất (MAC) để nhận dạng nó.
    + Địa chỉ MAC là thứ không thể bị thay đổi và được ghi vào card theo nghĩa đen, chúng đã được nhà sản xuất cài đặt sẵn và có thể bị giả mạo.
    + Tầng liên kết cũng thực hiện việc kiểm tra xem để chắc chắn rằng gói tin sẽ không bị hư hại trong quá trình truyền, thứ mà có thể bị khi dữ liệu ở tầng 1 - tầng vật lý
- Tầng 1, Physical:
    + Tầng vật lý là nơi ngay bên dưới phần cứng, đây là nơi tín hiệu được gửi và nhận bằng các xung điện. Tầng vật lý sẽ chuyển đổi các bit nhị phân thành các tín hiệu và truyền chúng đi qua mạng máy tính, đồng nhận tín hiệu truyền đi và chuyển chúng về các bit nhị phân.

## Đóng gói: 
- Dữ liệu truyền xuống từng tầng của mô hình sẽ được từng tầng thêm vào những thông tin được đề cập khi bắt đầu truyền. Ví dụ như ở tầng mạng, phần header củadữ liệu sẽ được thêm địa chỉ IP đích, hay ở tầng giao vận, phần header sẽ được thêm giao thức truyền dữ liệu. Đặc biệt tầng liên kết sẽ thêm vào một phần đuôi (trailer) dùng để xác minh rằng dữ liệu không bị mất khi truyền. Cả quá trình này được gọi là đóng gói(encapsulation), mô tả quá trình dữ liệu được gửi từ máy này sang máy khác.
- Cụ thể như ảnh sau:
    ![](https://i.imgur.com/L0G5eKc.png)
- Ở từng tầng, dữ liệu được đóng gói sẽ được gọi bằng những tên khác nhau.
- Khi máy tính còn lại nhận được dữ liệu, nó sẽ đảo ngược lại quá trình đóng gói, bắt đầu từ tầng vật lý lên tầng ứng dụng và loại bỏ dần những thông tin mà nó thêm vào trong quá trình truyền(header, trailer), đây được gọi là quá trình giải mã(de-encapsulation).

## Mô hình TCP/IP:
- Mô hình TCP/IP rất giống với mô hình OSI về nhiều mặt. TCP/IP ra đời sớm hơn vài năm và là cơ sở của mạng máy tính ngoài đời thực. TCP chỉ có 4 tầng: Application, Transport, Internet and Network Interface. Các tầng này bao gồm đầy đủ chức năng của các tầng đã giới thiệu ở mô hình OSI.
- Mô hình TCP/IP trực quan:
    ![](https://i.imgur.com/gJzNZwi.png)
- Cụ thể về sự tương đồng giữa 2 mô hình mạng máy tính OSI và TCP/IP:
    ![](https://i.imgur.com/faq4u9r.png)
- Như hình trên, ta cũng có thể thấy, mô hình OSI là bản mở rộng và phân bố đều các chức năng của mô hình TCP/IP 
- Các quy trình đóng gói của mô hình TCP/IP cũng tương tự như mô hình OSI, từng tầng sẽ gắn header vào dữ liệu rồi sẽ được mã hóa khi nhận được dữ liệu.
- Sở dĩ tên mô hình được gọi là TCP/IP vì nó thể hiện 2 giao thức quan trọng nhất được sử dụng trong mô hình: TCP(Transmission Control Protocol)điều khiển luồng dữ liệu giữa hai điểm cuối và IP(Internet Protocol) kiểm soát cách mà cách các gói được đánh địa chỉ và gửi đi. Bây giờ tôi sẽ nói về giao thức TCP.
- Như ta đã biết, TCP là giao thức dựa trên kết nối(connection-based), nghĩa là trước khi gửi dữ liệu bằng TCP, bạn phải có kết nối ổn định giữa 2 máy tính, và quá trình thiết lập kết nối này được gọi là bắt tay ba bước(*three-way handshake*), cụ thể như sau:
    + Khi bạn muốn thiết lập 1 kết nối, máy tính sẽ gửi một request đặc biệt đến server từ xa chỉ định rằng tôi muốn khởi tạo kết nối. Request này chứa 1 thứ gọi là bit SYN(viết tắt cho synchronise - đồng bộ hóa), về cơ bản nó là yếu tố cần thiết đầu tiên cho quá trình kết nối
    + Sau đó server sẽ trả lời bằng một gói chứa SYN bit và một bit "acknowledgement - xác nhận", gọi là ACK
    + Cuối cùng, máy tính của bạn sẽ gửi một gói chứa bit ACK, xác nhận rằng kết nối đã được thiết lập thành công.
- Hình ảnh cụ thể minh họa quá trình bắt tay 3 bước
    ![](https://i.imgur.com/B33kQQP.png)
**->** Khi thiết lập một kết nối TCP, bắt buộc phải thông qua quá trình bắt tay 3 bước

## Công cụ mạng máy tính: Ping
- Ping là một công cụ hữu hiệu trong việc kiểm tra xem liệu có thể kết nối được với nguồn tài nguyên từ xa không( thông thường sẽ là một website ở trên mạng). Nhưng cũng có thể là một máy tính trong mạng gia đình của bạn nếu bạn muốn kiểm tra xem nó có được cấu hình đúng hay không.
- Ping hoạt động dựa trên giao thức ICMP. Giao thức này hoạt động ở tầng Network ở mô hình OSI và tầng Internet của mô hình TCP/IP
- Cách sử dụng: `ping <target>`
    + Ví dụ: ![](https://i.imgur.com/YKlbC6J.png)
    + Lệnh ping trả về địa chỉ IP của máy chủ mà ta đã lập kết nối, không phải của URL ->  xác định địa chỉ IP của máy chủ lưu trữ một trang web
    + Một số switch cho câu lệnh ping:
    ![](https://i.imgur.com/dTo4jml.png)

## Công cụ mạng máy tính: Traceroute
- Tiếp theo ta sẽ đến với câu lệnh `traceroute`, câu lệnh dùng để định vị đợc đường đi request dùng để đến được máy tính của mục tiêu
- Internet có rất nhiều server và end-point, nên request sẽ phải đi qua khá nhiều server để đến được đích, `traceroute` cho phép ta nhìn được những đường đi này
- Với windows câu lệnh là: `tracert` sẽ mặc định sử dụng giao thức ICMP cho traceroute, tương đương với Linux sử dụng UDP.
- Cách sử dụng: `traceroute <destination>`
    + Ví dụ: 
    ![](https://i.imgur.com/bfCFR3r.png)
    ![](https://i.imgur.com/yGKaVaf.png)

## Công cụ máy tính: WHOIS
- Tên miền - vị cứu tinh vô danh của internet.
- Tên miền sẽ là thứ để chúng ta định danh 1 trang web mà không cần phải nhớ địa chỉ IP của nó. Ví dụ: Ta có thể nhập tryhackme.com thay vì địa chỉ IP TryHackMe
- Về cơ bản, Whois cho phép bạn truy vấn ai đã đăng ký một tên miền. Ở châu Âu, các chi tiết cá nhân được biên tập lại; tuy nhiên, ở những nơi khác, bạn có thể có được rất nhiều thông tin từ tìm kiếm whois.
- Lưu ý: Bạn có thể cần phải cài đặt whois trước khi sử dụng nó. Cách cài đặt ở trên hệ thống Debian: `sudo apt update && sudo apt-get install whois`
- Cách sử dụng: `whois <domain>`

## Công cụ máy tính: Dig
- Bây giờ chúng ta sẽ tìm hiểu về cách miền hoạt động, dựa vào một giao thức TCP/IP là DNS(Domain Name System), ta có thể chuyển đổi URL thành địa chỉ IP để máy tính có thể hiểu được.
- Về cơ bản thì DNS cho phép ta yêu cầu một máy chủ đặc biệt cung cấp địa chỉ IP của trang web mà ta đang cố truy cập. Ví dụ: nếu ta đưa ra yêu cầu tới www.google.com, máy tính trước tiên sẽ gửi yêu cầu tới một máy chủ DNS đặc biệt (mà máy tính của bạn đã biết cách tìm). Sau đó, máy chủ sẽ tìm kiếm địa chỉ IP cho Google và gửi lại cho máy tính. Cuối cùng, máy tính sẽ gửi yêu cầu tới IP của máy chủ Google.
- Để tôi giải thích cụ thể hơn 1 chút:
    + Bạn thực hiện một yêu cầu cho một trang web. Máy tính sẽ kiểm tra bộ đệm cục bộ để xem liệu nó đã có địa chỉ IP được lưu cho trang web hay chưa. Nếu có thì nó sẽ chuyển đến trang web, nếu không nó sẽ chuyển sang giai đoạn tiếp theo.
    + Máy tính của bạn sẽ gửi yêu cầu đến server DNS đệ quy. Server sẽ có một bộ đệm chứa kết quả của các tên miền phổ biến. Tuy nhiên, nếu trang web bạn yêu cầu không được lưu trữ trong bộ đệm, server đệ quy sẽ chuyển yêu cầu tới server root name.
    + Về cơ bản, các server root name theo dõi các server DNS ở cấp độ thấp hơn, chọn một server thích hợp để chuyển hướng yêu cầu của bạn đến. Các server cấp thấp hơn này được gọi là Top-Level Domain servers.
- Khi bạn truy cập vào trang web bằng web browser thì tất cả điều này đều tự động diễn ra, nhưng chúng ta có thể làm thủ công bằng câu lệnh `dig`, giống như `ping` và `traceroute`, `dig` có sẵn trong thư viện câu lệnh của Linux
- `Dig` cho phép ta truy vấn thủ công các server DNS đệ quy mà ta chọn để biết thông tin về các miền
- Cách sử dụng: `dig <domain> @<dns-server-ip>`
- `dig` là công cụ hữu dụng trong khắc phục sự cố mạng
- Chú ý: đơn vị của TTL(Time To Live) là giây
    
# TRYHACKME: WEB APPLICATION SECURITY WALKTHROUGH
---

## Giới thiệu
- Mỗi chúng ta đểu sử dụng các chương trình khác nhau trên máy tính. Nói chung, khi các chương trình chạy trên máy tính, chúng sẽ sử dụng bộ nhớ và bộ xử lý và để sử dụng một chương trình, chúng ta cần phải cài đặt nó. Nhưng hiện tại ta có những chương trình có thể chạy mà không cần phải cài đặt, đó chính là các ứng dụng web
- Ứng dụng web(web application) giống một "chương trình" nhưng ta không cần phải cài đặt chúng để sử dụng, miễn là ta có một trình duyệt web(web browser). Từ đó, thay vì phải cài đặt từng chương trình bạn cần, bạn chỉ cần duyệt qua các trang liên quan. Ví dụ về các ứng dụng web như: shopee, gmail, ...
- Ý tưởng xuất hiện ứng dụng web sẽ bắt nguồn từ việc một chương trình chạy từ một máy chủ từ xa. Máy chủ này sẽ chạy liên tục để phục vụ các khách hàng hay người dùng web. Web sẽ cung cấp các chức năng để người dùng có thể tương tác và khi người dùng tước tác máy chủ sẽ gửi chạy một loại chương trình cụ thể mà trình duyệt web có thể truy cập được.
- Vì vậy, trong quá trình thực hiện các chức năng, rất có khả năng hacker có thể tiến hành tấn công để khai thác thông tin của khách hàng từ cơ sở dữ liệu hay ăn cắp cookie,... Việc phát hiện lỗi và bảo mật lỗi cho trang web là việc cần thiết để đảm bảo tránh tổn thất cho công ty và cho khách hàng.

## Những lỗ hổng cơ bản trong bảo mật web
- Đa số những lỗ hổng đều được khai thác từ các chức năng mà trang web đưa cho người dùng, ví dụ như: đăng nhập, đăng ký, quên mật khẩu, tìm kiếm sản phẩm, thanh toán,... Ta sẽ đến với những lỗ hổng phổ biến nhất của bảo mật web.
### Lỗi Nhận dạng Và Xác thực (Identification and Authentication Failure)
- Nhận dạng đề cập đến khả năng xác định người dùng duy nhất. Ngược lại, xác thực đề cập đến khả năng chứng minh rằng người dùng chính là người dùng thực sự. 
- Trang web phải yêu cầu xác thực và xác nhận danh tính trước khi có thể tiến vào trang web. Tuy nhiên, bước nãy có thể xảy ra nhiều điểm yếu khác nhau, giả dụ như:
    + Cho phép hacker brute-force (thử nhiều mật khẩu) bằng các công cụ tự động để tìm được thông tin hợp lệ
    + Cho phép đăng ký mật khẩu dễ đoán
    + Lưu trữ mật khẩu dưới dạng text thường, nếu hacker có được file password thì dễ dàng sẽ bị brute-force
### Lỗi Kiểm Soát Truy Cập (Broken Access Control)
- Kiểm soát truy cập đảm bảo rằng mỗi người dùng chỉ có thể truy cập các tệp (tài liệu, hình ảnh,...) liên quan đến vai trò hoặc công việc của họ. Những lỗi liên quan đến kiểm soát truy cập có thể kể đến như:
    + Không áp dụng nguyên tắc ***đặc quyền tối thiểu*** và cấp cho người dùng nhiều quyền truy cập hơn mức họ cần. Ví Dụ: một khách hàng trực tuyến có thể xem giá của các mặt hàng nhưng họ không nên có quyền thay đổi chúng.
    + Có thể xem hoặc sửa đổi tài khoản của người khác bằng cách sử dụng số nhận dạng duy nhất của tài khoản đó. Ví Dụ: thông qua ID,....
    + Có thể duyệt các trang yêu cầu xác thực (đăng nhập) với tư cách là người dùng chưa được xác thực. 
### Injection
- Đây là lỗ hổng khi hacker có thể chèn mã độc hại vào một phần của đầu vào của họ( có thể là username, password,...). Một nguyên nhân của lỗ hổng này là do thiếu xác nhận hợp lệ và lọc đầu vào của người dùng.
### Lỗi Mật Mã (Cryptographic Failures)
- Việc mã hóa là để đảm bảo rằng không ai có thể đọc được dữ liệu nếu không biết khóa bí mật. Việc giải mã chuyển đổi bản mã trở lại thành bản ban đầu bằng khóa bí mật. Các ví dụ của lỗi mật mã có thể là:
    + Gửi dữ liệu nhạy cảm ở dạng văn bản, chẳng hạn như sử dụng HTTP thay vì HTTPS. HTTP là giao thức được sử dụng để truy cập web, trong khi HTTPS là phiên bản bảo mật của HTTP. Những người khác có thể đọc mọi thứ bạn gửi qua HTTP nhưng HTTPS thì không.
    + Dựa vào một thuật toán yếu.Ví dụ như: Một thuật toán mã hóa cũ là dịch từng ký tự một, mã hóa “TRYHACKME” thành “USZIBDLNF.” Thuật toán này rất dễ phá vỡ.
    + Sử dụng khóa mặc định hoặc khóa yếu cho các chức năng mật mã. Sẽ không khó để phá khóa mã hóa được sử dụng `1234` làm khóa bí mật.
## Ví dụ thực tế về bảo mật web:
- IDOR (INSECURE DIRECT OBJECT REFERENCE) là một lỗ hổng bảo mật mà trong đó người dùng có thể truy cập và thay đổi dữ liệu của bất kỳ người dùng nào khác có trong hệ thống.
- Giả sử như `https://store.tryhackme.thm/customers/user?id=16` sẽ trả lại người dùng bằng `id=16`. Kẻ tấn công sẽ thử các số khác và có thể truy cập vào các tài khoản người dùng khác. Nếu bạn là ID số 16 và ID số 17 là người dùng khác, bằng cách thay đổi ID thành 17, bạn có thể xem dữ liệu nhạy cảm thuộc về người dùng khác. Tương tự như vậy, họ có thể thay đổi ID thành 16 và xem dữ liệu thuộc về bạn.
- Ở lab này, ta sẽ đổi id của customer > 11, ta sẽ thấy không có, nên em tiếp tục để id từ 1 và hiện ra 1 số nhân viên, xong rồi em đã gặp nhân viên id số 9 đã thay đổi các đơn hàng, hoàn lại các đơn hàng và em đã có flag:
    ![](https://i.imgur.com/DxlSzQU.png)

# TRYHACKME: PENTESTING FUNDAMENTALS WALKTHROUGH
---
## Pentest(Penetration Testing) là gì?
- Pentest là tìm kiếm lỗ hổng trong ứng dụng hoặc hệ thống khách hàng
- Việc truy nhập và khai thác lỗ hổng của pentest là việc làm cần thiết, và yêu cầu người pentest phải có đạo đức 
- Pentest sinh ra để kiểm tra và phân tích các biện pháp bảo vệ an ninh nhằm bảo vệ các thông tin của khách hàng và của công ty. Việc pentest sẽ sử dụng những công cụ, kỹ thuật và phương pháp tương tự như một hacker đang cố khai thác lỗ hổng của một trang web.
## Vấn đề đạo đức trong PenTest
- Có 3 loại hacker, tượng trưng cho đạo đức của các loại hacker:
    + Hacker mũ trắng: Những tin tặc này được coi là "người tốt". Họ tuân thủ luật pháp và sử dụng các kỹ năng của mình để mang lại lợi ích cho người khác.
    + Hacker mũ xám: Những người này thường xuyên sử dụng các kỹ năng của họ để mang lại lợi ích cho người khác; tuy nhiên, họ không phải lúc nào cũng tôn trọng/tuân thủ pháp luật hoặc các chuẩn mực đạo đức.
    + Hacker mũ đen: Những người này là tội phạm và thường tìm cách gây thiệt hại cho các tổ chức hoặc đạt được một số hình thức lợi ích tài chính với chi phí của những người khác. 
- ROE(Rules Of Engagement): ROE là một loại tài liệu được tạo ra trước khi pentester tiến hành tổ chức xâm nhập vào trang web. Tài liệu này bao gồm:
    + Permission(Quyền): đưa ra những quyền cụ thể để cam kết được thực thi
    + Test Scope(Phạm vi thử nghiệm): chú thích các mục tiêu cụ thể mà cam kết sẽ áp dụng
    + Rules(Quy tắc): xác định chính xác các kỹ thuật được phép trong quá trình thực hiện
## Phương pháp Pentest: 
- Pentester thường sẽ thực thiện tuần tự các bước như sau:

| Giai đoạn | Mô tả chi tiết | 
| -------- | -------- |
| Thu thập thông tin| Thu thập càng nhiều thông tin có thể truy cập và được công bố về mục tiêu/ tổ chức càng tốt (OSINT, research)|
|Liệt kê/Scan|Khám phá các ứng dụng và dịch vụ đang chạy trên hệ thống|
|Khai thác|Tận dụng các lỗ hổng được phát hiện trên một hệ thống hoặc ứng dụng|
|Nâng cấp đặc quyền|Mở rộng quyền truy cập của bạn vào hệ thống|
|Sau-khai thác|Báo cáo|
- Một số Framework phổ biến trong pentest và ứng dụng của nó:
    + OSSTMM: Viễn thông, mạng có dây 
    + OWASP: ứng dụng web và dịch vụ web
    + NIST Cybersecurity Framework 1.1:
    + NCSC CAF
## Black box, White box, Grey box trong PenTest
- Chúng ta có 3 phạm vi chính trong pentest: black box, grey box và white box
- Kiểm tra Black-box: 
    + Đây là dạng kiểm tra bậc cao mà pentester không được cung cấp bất kỳ thông tin nào về hoạt động bên trong, hay source code của trang web
    + Pentester sẽ kiểm tra những chức năng và cách thức tương tác đối với user của trang web
- Kiểm tra Grey-box:
    + Đây là dạng phổ biến nhất cho pentest, đây là sự kết hợp giữa black-box và white-box. Pentester sẽ có một số thông tin về cách thức hoạt động bên trong trang web 
    + Mục đích tìm vẫn giống với black-box, tìm kiếm lỗ hổng trong chức năng và dịch vụ từ đó tìm ra cách sửa lỗi 
- Kiểm tra White-box: 
    + Dạng kiểm tra này được sẽ cho pentester biết source code của trang web, từ đó ta cần phải kiểm tra xem chức năng bên trong trang web hoạt động ổn định không trong khoảng thời gian nhất định
## Thực tế: Pentest ACME
![](https://i.imgur.com/ZtOjzt8.png)

# TRYHACKME:BASIC PENTESTING
- 
