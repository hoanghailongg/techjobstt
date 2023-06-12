import csv
import requests
from bs4 import BeautifulSoup
from tqdm import tqdm

# Gửi yêu cầu GET đến URL
url = "https://www.vietnamworks.com/hrinsider/hanh-trang-fresher"
response = requests.get(url)

# Tạo đối tượng BeautifulSoup từ nội dung trang web
soup = BeautifulSoup(response.content, "html.parser")

# Tìm tất cả các thẻ div chứa class "item"
items = soup.find_all("div", class_="item")

# Tạo danh sách để lưu trữ dữ liệu
data = []

# Tạo thanh tiến trình
progress_bar = tqdm(total=len(items), desc="Processing", unit="item")

# Lặp qua các item
for item in items:
    # Lấy link ảnh src từ thẻ img là con của thẻ div có class là "thumb"
    image = item.find("div", class_="thumb").img["src"]

    # Tìm thẻ detail và lấy title từ text của thẻ a là thẻ con của thẻ span.article, lấy link từ thẻ a là con của thẻ đó
    detail = item.find("span", class_="article").a
    title = detail.get_text()
    link = "https://www.vietnamworks.com" + detail["href"]

    # Lấy description là text của thẻ p là thẻ con của thẻ div có class là "des"
    description = item.find("div", class_="des").p.get_text()

    # Truy cập vào link và lấy toàn bộ text trong thẻ div có class "box-content"
    link_response = requests.get(link)
    link_soup = BeautifulSoup(link_response.content, "html.parser")
    box_post = link_soup.find("div", class_="box-content")
    content = ""
    for element in box_post.contents:
        if element.name == "blockquote":
            break
        if element.name is None:
            content += str(element)
        elif element.name == "p":
            content += element.get_text(separator=" ")

    # Thêm dữ liệu vào danh sách
    data.append([title.strip(), image.strip(), link.strip(), description.strip(), content.strip()])
    # Cập nhật tiến trình
    progress_bar.update(1)

# Đóng thanh tiến trình
progress_bar.close()

# Lưu dữ liệu vào file CSV
csv_filename = "./database/scrape-data/hanh-trang-fresher.csv"
with open(csv_filename, "w", newline="", encoding="utf-8") as csv_file:
    writer = csv.writer(csv_file)
    writer.writerow(["Title", "Image", "Link", "Description", "Content"])  # Ghi tiêu đề cột
    writer.writerows(data)  # Ghi dữ liệu

print("Dữ liệu đã được lưu vào file", csv_filename)