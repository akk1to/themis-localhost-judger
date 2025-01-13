<?php
date_default_timezone_set("Asia/Bangkok"); 
//Tên kỳ thi
$contestName = "CSP Olympiad in Informatics"; 
//Mô tả kỳ thi
$description = "<a href = './tools/'>Các IDE và bộ dịch.</a>";
//footer
$footer = "Keep typing, keep loving";
//Thư mục chưa đề (định dạng pdf, jpg hoặc zip)
$problemsDir = "contests/problems";
//Tên file đề tổng hợp
$problemsFile = "Debai.pdf";
//Thư mục chứa test
$examTestDir = "contests/tests";
//Tên file test tổng hợp
$examTestFile = "Full.contest";
//Thư mục lưu bài làm trực tuyến của học sinh
$uploadDir = "a:/submit/";	
//Thư mục chứa file logs
$logsDir = "a:/submit/Logs/";
$logssubDir = "a:/submit/Logs/";
$startTime = date_create("2016-12-27 8:00:00",timezone_open("Asia/Bangkok")); //YYYY-MM-DD HH:MM:SS
//Thời gian bắt đầu kỳ thi (định dạng HH, MM, SS, MM, DD, YYYY)
$begintime = mktime(8, 0, 0, 12, 27, 2016);
//Thời gian làm bài - (đặt 0: không giới hạn)
$duringTime = 0; //(phút)
//1: Công bố kết quả sau khi chấm, 0: không công bố.
$publish = 1;	
?>