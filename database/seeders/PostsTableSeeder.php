<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use League\Csv\Reader;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Đường dẫn tới thư mục chứa các file CSV
        $csvDirectory = database_path('scrape-data');

        // Lấy danh sách các file CSV trong thư mục
        $csvFiles = scandir($csvDirectory);

        // Lặp qua các file CSV
        foreach ($csvFiles as $csvFile) {
            // Bỏ qua các file không phải là file CSV
            if (pathinfo($csvFile, PATHINFO_EXTENSION) !== 'csv') {
                continue;
            }

            // Đường dẫn đến file CSV
            $csvFilePath = $csvDirectory . DIRECTORY_SEPARATOR . $csvFile;

            // Đọc dữ liệu từ file CSV
            $data = $this->readCSV($csvFilePath);

            // Lấy tên file CSV (loại bỏ phần mở rộng .csv)
            $fileName = pathinfo($csvFile, PATHINFO_FILENAME);

            $category = match ($fileName) {
                'hanh-trang-fresher' => 'Hành Trang Fresher',
                'hanh-trang-yeu-nghe' => 'Hành Trang Yêu Nghề',
                'nha-tuyen-dung' => 'Nhà Tuyển Dụng',
                'tim-nghe-khong-kho' => 'Tìm Nghề Không Khó',
            };

            // Lặp qua các dòng dữ liệu
            foreach ($data as $row) {
                // Tạo một instance của model Post
                $post = new Post();

                // Lưu trường Image
                $imagePath = $this->saveImageToStorage($row['Image']);
                $post->thumb = $imagePath;

                // Lưu các trường khác
                $post->title = $row['Title'];
                $post->description = $row['Description'];
                $post->content = $row['Content'];
                $post->category = $category;
                $post->slug = Str::slug($row['Title']);

                // Lưu model Post vào cơ sở dữ liệu
                $post->save();
            }
        }
    }

    private function readCSV($csvFilePath)
    {
        $csv = Reader::createFromPath($csvFilePath, 'r');
        $csv->setHeaderOffset(0);
        return iterator_to_array($csv->getRecords());
    }

    private function saveImageToStorage($imageURL)
    {
        // Tải ảnh từ URL và lưu vào storage
        $imageData = file_get_contents($imageURL);
        $imageName = 'posts/' . uniqid() . '.jpg';
        Storage::disk('public')->put($imageName, $imageData);

        // Lấy đường dẫn tới ảnh đã lưu
        return 'storage/' . $imageName;
    }
}
