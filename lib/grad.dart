import 'package:flutter/cupertino.dart';
import 'package:flutter/material.dart';

class Grad extends StatefulWidget {
  const Grad({super.key});

  @override
  State<Grad> createState() => _GradState();
}

class _GradState extends State<Grad> {
  @override
  Widget build(BuildContext context) {

    return Scaffold(
      backgroundColor: Colors.amber,
      appBar: AppBar(
        title:Text('الدرجات') ,
      ),
      body: Center(

        child: Text('لا يوجد حاليا بيان درجات اليوم' , style: TextStyle(fontSize: 50 , fontWeight: FontWeight.bold),),
      ),
    );

  }
}
