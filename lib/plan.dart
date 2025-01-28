import 'package:flutter/cupertino.dart';
import 'package:flutter/material.dart';

class Plan extends StatefulWidget {
  const Plan({super.key});

  @override
  State<Plan> createState() => _PlanState();
}

class _PlanState extends State<Plan> {
  @override
  Widget build(BuildContext context) {

    return Scaffold(
    backgroundColor: Colors.amber,
    appBar: AppBar(
    title: Text('الخطة الدراسية'),
    centerTitle: true,

    ),
    body: Center(
    child: Image.asset("assets/images/planimg.jpg",height: 1250,width: 1250,),
    ),
    );

  }
}
