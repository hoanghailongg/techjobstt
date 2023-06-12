# Text for the ChatGPT
    1. Đi tới url "https://www.vietnamworks.com/hrinsider/nha-tuyen-dung"
       - Tìm kiếm thẻ articles và thực hiện: 
       - Tìm kiếm các thẻ div chứa class item, lặp qua các item đó và lấy các dữ liệu như sau:
          + link ảnh src từ thẻ img là con của thẻ div có class là thumb.
          + tìm kiếm thẻ detail và lấy title từ text của thẻ a là thẻ con của thẻ span.article, lấy link từ thẻ a là con của thẻ đó.
          + description là text của thẻ p là thẻ con của thẻ div có class là des

    2. lưu các dữ liệu trên vào file csv 

    vui lòng sửa tập lệnh để có thể thực hiện thêm các công việc sau:
    trong khi lặp, sau khi lấy được link thì sẽ nối thêm chuỗi "https://www.vietnamworks.com" vào trước để tạo link hoàn chỉnh.

    truy cập vào link và lấy toàn bộ text trong thẻ div có class box-post và lưu vào content