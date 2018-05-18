<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            ['name' => 'Kim Thi Hai Ha', 'email' => 'kimthihaiha@gmail.com', 'password' => bcrypt('123456')],
            ['name' => 'Tran Hoang Long', 'email' => 'tranhoanglong@gmail.com', 'password' => bcrypt('123456')],
            ['name' => 'Tong Thi Minh Ngoc', 'email' => 'tongthiminhngoc@gmail.com', 'password' => bcrypt('123456')],
            ['name' => 'Cao Thi Thu Huong', 'email' => 'caothithuhuong@gmail.com', 'password' => bcrypt('123456')],
            ['name' => 'Tran Thi My Diep', 'email' => 'tranthimydiep@gmail.com', 'password' => bcrypt('123456')],
            ['name' => 'Pham Thao', 'email' => 'phamthao@gmail.com', 'password' => bcrypt('123456')],
            ['name' => 'Dang Minh Quan', 'email' => 'dangminhquan@gmail.com', 'password' => bcrypt('123456')],
            ['name' => 'Pham Thi Trang', 'email' => 'phamthitrang@gmail.com', 'password' => bcrypt('123456')],

            ['name' => 'Hoang Thi Thanh', 'email' => 'hoangthithanh@gmail.com', 'password' => bcrypt('123456')],
            ['name' => 'Dao Thi Thu', 'email' => 'daothithu@gmail.com', 'password' => bcrypt('123456')],
            ['name' => 'Nguyen Thi Thu Hang', 'email' => 'nguyenthithuhang@gmail.com', 'password' => bcrypt('123456')],
            ['name' => 'Dinh Thi Oanh', 'email' => 'dinhthioanh@gmail.com', 'password' => bcrypt('123456')],
            ['name' => 'Nguyen Thi Linh', 'email' => 'nguyenthilinh@gmail.com', 'password' => bcrypt('123456')],
            ['name' => 'Tran Thanh Son', 'email' => 'tranthanhson@gmail.com', 'password' => bcrypt('123456')],
            ['name' => 'Le Duy Bach', 'email' => 'leduybach@gmail.com', 'password' => bcrypt('123456')],
            ['name' => 'Nguyen Tien Cong', 'email' => 'nguyentiencong@gmail.com', 'password' => bcrypt('123456')],
            ['name' => 'Le Bui Tuan Nghia', 'email' => 'lebuituannghia@gmail.com', 'password' => bcrypt('123456')],
            ['name' => 'Dang Ngoc Giang', 'email' => 'dangngocgiang@gmail.com', 'password' => bcrypt('123456')],
                    ];
        DB::table('users')->insert($users);
    }
}
