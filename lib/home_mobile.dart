import 'package:flutter/cupertino.dart';
import 'package:flutter/material.dart';
import 'package:learn/grad.dart';
import 'package:learn/plan.dart';
import 'package:learn/tabl.dart';
import 'package:learn/tast.dart';
import 'lecter.dart';

class HomeMobile extends StatefulWidget {
  const HomeMobile({super.key});

  @override
  State<HomeMobile> createState() => _HomeMobileState();
}

class _HomeMobileState extends State<HomeMobile> {
  @override
  Widget build(BuildContext context) {
    return Scaffold(
      backgroundColor: Colors.amber,
      appBar: AppBar(
        title: Text('مرحبا بك في موقعنا الالكتروني للتعلم عن بعد'),
        centerTitle: true,

      ),
      body: SingleChildScrollView(
        scrollDirection: Axis.vertical, // تمرير عمودي
        child: Padding(
          padding: const EdgeInsets.only(left: 120 , right: 120), // استخدم Padding بشكل عام
          child: Column(
            children: [
              SizedBox(height: 50,),
              buildOptionCard(
                title: "الاختبارات",
                imagePath: "assets/images/test.jpg",
                page: Test(),
              ),
              SizedBox(height: 70), // مساحة بين العناصر
              buildOptionCard(
                title: "الواجبات",
                imagePath: "assets/images/home.jpg",
                page: Test(),
              ),
              SizedBox(height: 70),
              buildOptionCard(
                title: "الجداول",
                imagePath: "assets/images/table.jpg",
                page: Tabl(),
              ),
              SizedBox(height: 70),
              buildOptionCard(
                title: "المحاضرات",
                imagePath: "assets/images/lector.jpg",
                page: Lecter(),
              ),
              SizedBox(height: 70),
              buildOptionCard(
                title: "الخطة الدراسية",
                imagePath: "assets/images/planing.jpg",
                page: Plan(),
              ),
              SizedBox(height: 70),
              buildOptionCard(
                title: "كشف الدرجات",
                imagePath: "assets/images/grad.jpg",
                page: Grad(),
              ),
            ],
          ),
        ),
      ),
    );
  }

  Widget buildOptionCard({
    required String title,
    required String imagePath,
    required Widget page,
  }) {
    return Padding(
      padding: const EdgeInsets.only(bottom: 20.0), // مسافة بين البطاقات
      child: Container(
        width: 330,
        height: 180,
        decoration: BoxDecoration(
          color: Colors.white,
          borderRadius: BorderRadius.circular(10),
        ),
        child: Padding(
          padding: const EdgeInsets.only(top: 30.0),
          child: Column(
            children: [
              Text(title),
              SizedBox(height: 14),
              TextButton(
                onPressed: () {
                  Navigator.push(
                      context, MaterialPageRoute(builder: (context) => page));
                },
                child: Image.asset(
                  imagePath,
                  height: 100,
                  width: 100,
                ),
              ),
            ],
          ),
        ),
      ),
    );
  }
}
