import 'package:flutter/material.dart';
import 'package:learn/result.dart';

void main() {
  runApp(Tast());
}

class Tast extends StatelessWidget {
  @override
  Widget build(BuildContext context) {
    return MaterialApp(
      home: Scaffold(
        appBar: AppBar(
          title: Text('اختبار'),
          centerTitle: true,
          backgroundColor: Colors.amber,
        ),
        body: Test(),
      ),
    );
  }
}

class Test extends StatefulWidget {
  @override
  _TestState createState() => _TestState();
}

class _TestState extends State<Test> {
  // قائمة الأسئلة والإجابات
  final List<Question> questions = [
    Question(
      type: QuestionType.MultipleChoice,
      questionText: 'what is  language Flutter ? ',
      options: ['Dart', 'C#', 'PHP', 'JAVA'],
      correctAnswer: 'Dart',
    ),


  ];

  // تخزين الإجابات التي يختارها المستخدم
  Map<int, String> selectedAnswers = {};

  @override
  Widget build(BuildContext context) {
    return ListView.builder(
      padding: EdgeInsets.all(10),
      itemCount: questions.length,
      itemBuilder: (context, index) {
        final question = questions[index];
        return
          Column(
            children: [
              Card(
              margin: EdgeInsets.symmetric(vertical: 10),
              shape: RoundedRectangleBorder(
                borderRadius: BorderRadius.circular(15),
              ),
              child: Padding(
                padding: EdgeInsets.all(15),
                child: Column(
                  crossAxisAlignment: CrossAxisAlignment.start,
                  children: [
                    Text(
                      question.questionText,
                      style: TextStyle(fontSize: 18, fontWeight: FontWeight.bold),
                    ),
                    SizedBox(height: 10),
                    if (question.type == QuestionType.MultipleChoice)
                      ...question.options!.map((option) => RadioListTile<String>(
                        title: Text(option),
                        value: option,
                        groupValue: selectedAnswers[index],
                        onChanged: (value) {
                          setState(() {
                            selectedAnswers[index] = value!;
                          });
                        },
                      )),
                    if (question.type == QuestionType.TrueFalse)
                      Column(
                        children: [
                          RadioListTile<String>(
                            title: Text('صح'),
                            value: 'صح',
                            groupValue: selectedAnswers[index],
                            onChanged: (value) {
                              setState(() {
                                selectedAnswers[index] = value!;
                              });
                            },
                          ),
                          RadioListTile<String>(
                            title: Text('خطأ'),
                            value: 'خطأ',
                            groupValue: selectedAnswers[index],
                            onChanged: (value) {
                              setState(() {
                                selectedAnswers[index] = value!;
                              });
                            },
                          ),

                        ],
                      ),

                  ],
                ),
              ),
        ),
              TextButton(onPressed: (){
                Navigator.push(context, MaterialPageRoute(builder:(context)=>Result() ));
              }, child: Text("ارسال" , style: TextStyle(fontWeight: FontWeight.bold,fontSize: 40),))
            ],
          );

      },

    );

  }
}

// نموذج السؤال
class Question {
  final QuestionType type;
  final String questionText;
  final List<String>? options;
  final String correctAnswer;

  Question({
    required this.type,
    required this.questionText,
    this.options,
    required this.correctAnswer,
  });
}

// نوع السؤال
enum QuestionType {
  MultipleChoice,
  TrueFalse,
}
