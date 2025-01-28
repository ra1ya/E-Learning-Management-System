import 'package:flutter/cupertino.dart';
import 'package:flutter/material.dart';
import 'package:learn/HomeDesktop.dart';

class Result extends StatefulWidget {
  const Result({super.key});

  @override
  State<Result> createState() => _ResultState();
}

class _ResultState extends State<Result> {
  @override
  Widget build(BuildContext context) {

    return Scaffold(
    backgroundColor: Colors.amber,
    appBar: AppBar(
    title:Text('النتائج') ,
    ),
    body: Column(
      children: [
        Center(

        child: Text('تم تسليم بياناتك بنجاح' , style: TextStyle(fontSize: 50 , fontWeight: FontWeight.bold),),
        ),

        TextButton(onPressed: (){
          Navigator.push(context, MaterialPageRoute(builder:(context)=>HomeDesktop() ));
        }, child: Text("عودة للصفحة الرئيسية" , style: TextStyle(fontWeight: FontWeight.bold,fontSize: 40),))
      ],
    ),
    );

  }
}
