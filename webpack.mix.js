const mix = require('laravel-mix');

mix.js('resources/js/app.js', 'public/js') // คอมไพล์ไฟล์ JavaScript และบันทึกใน public/js
   .sass('resources/sass/app.scss', 'public/css') // คอมไพล์ไฟล์ SASS/CSS และบันทึกใน public/css
   .sourceMaps() // เปิดใช้งาน Source maps เพื่อช่วยในการตรวจสอบข้อผิดพลาด
   .version(); // เพิ่มรุ่นให้กับครังข้อมูล (สำหรับการล้างแคช)
