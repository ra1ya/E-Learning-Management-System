import 'package:flutter/cupertino.dart';
import 'package:flutter/material.dart';

class Lecter extends StatefulWidget {
  const Lecter({super.key});

  @override
  State<Lecter> createState() => _LecterState();
}

class _LecterState extends State<Lecter> {
  @override
  Widget build(BuildContext context) {
    return Scaffold(
      backgroundColor: Colors.amber,
      appBar: AppBar(
        title:Text('محاضرة') ,
      ),
      body: Center(

        child: Text('لا توجد محاضرة اليوم' , style: TextStyle(fontSize: 50 , fontWeight: FontWeight.bold),),
      ),
    );
  }
}
