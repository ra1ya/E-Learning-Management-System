import 'package:flutter/material.dart';
import 'package:learn/grad.dart';
import 'package:learn/plan.dart';
import 'package:learn/tabl.dart';
import 'package:learn/tast.dart';
import 'lecter.dart';

class HomeDesktop extends StatefulWidget {
  const HomeDesktop({super.key});

  @override
  State<HomeDesktop> createState() => _HomeDesktopState();
}

class _HomeDesktopState extends State<HomeDesktop> {
  @override
  Widget build(BuildContext context) {
    return Scaffold(
      backgroundColor: Colors.amber,
      appBar: AppBar(
        title: Text('مرحبا بك في موقعنا الالكتروني للتعلم عن بعد'),
        centerTitle: true,
      ),
      body: Center(
        child: SingleChildScrollView(
          scrollDirection: Axis.vertical,
          child: SingleChildScrollView(
            scrollDirection: Axis.horizontal,
            child: ConstrainedBox(
              constraints: BoxConstraints(
                minWidth: MediaQuery.of(context).size.width,
                minHeight: MediaQuery.of(context).size.height,
              ),
              child: Padding(
                padding: const EdgeInsets.symmetric(horizontal: 140.0, vertical: 50.0),
                child: Column(
                  crossAxisAlignment: CrossAxisAlignment.center,
                  children: [
                    Row(
                      mainAxisAlignment: MainAxisAlignment.center,
                      children: [
                        buildOptionCard(
                          context,
                          title: "الاختبارات",
                          imagePath: "assets/images/test.jpg",
                          page: Test(),
                        ),
                        buildOptionCard(
                          context,
                          title: "الواجبات",
                          imagePath: "assets/images/home.jpg",
                          page: Test(),
                        ),
                        buildOptionCard(
                          context,
                          title: "الجداول",
                          imagePath: "assets/images/table.jpg",
                          page: Tabl(),
                        ),
                      ],
                    ),
                    SizedBox(height: 30), // Space between rows
                    Row(
                      mainAxisAlignment: MainAxisAlignment.center,
                      children: [
                        buildOptionCard(
                          context,
                          title: "المحاضرات",
                          imagePath: "assets/images/lector.jpg",
                          page: Lecter(),
                        ),
                        buildOptionCard(
                          context,
                          title: "الخطة الدراسية",
                          imagePath: "assets/images/planing.jpg",
                          page: Plan(),
                        ),
                        buildOptionCard(
                          context,
                          title: "كشف الدرجات",
                          imagePath: "assets/images/grad.jpg",
                          page: Grad(),
                        ),
                      ],
                    ),
                  ],
                ),
              ),
            ),
          ),
        ),
      ),
    );
  }

  Widget buildOptionCard(
      BuildContext context, {
        required String title,
        required String imagePath,
        required Widget page,
      }) {
    return Padding(
      padding: const EdgeInsets.all(20.0),
      child: Container(
        width: 330,
        height: 180,
        decoration: BoxDecoration(
          color: Colors.white,
          borderRadius: BorderRadius.circular(10),
        ),
        child: Column(
          mainAxisAlignment: MainAxisAlignment.center,
          children: [
            Text(title, style: TextStyle(fontSize: 20)),
            const SizedBox(height: 14),
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
    );
  }
}
