
|   | Last Updated 1/4/2017 |
|-------------|------------:|
#### Capacitor Project
###### by Marco Rubio


During some free time I had I decided to build a giant capacitor from scratch in an attempt to build a large energy bank for an alternative energy source that I could use to power miscallanious projects in the future. The capacitor project was really fun and I must revisit this project again in the future since I did not get the results I wanted. 

For this project I used wax paper and aluminum. I went to the closests dollar store and bough two rolls of wax paper and one roll of thin aluminum paper.

1. I cut out one of the aluminum sheet rolls in half to decrease the width of the aluminum sheets and to get the two layers i was going to need. This would also give me some room for unaligment that would occur in the process of rolling the sheets together.

2. I layed a layers in the fallowing manner: wax paper, aluminum, wax paper, aluminum. 

3. I rolled the layers together carefully as to try and have as much overlap as possible between the layers.and this is where things got difficult.

4. Connected/Soldered some copper wires to each aluminum sheet.

The circuit I built to test this device was the fallowing

I wrote some arduino code to measure capacitance: 

~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
// -t/(R * ln(1-(Vfinal/Vsource))) = C
// -t/(R * ln(1-0.98)) = C
// R = 100 Ohms
//(R * ln(0.02)) = -391.2023005

float formula = 3912023;
unsigned long timer;
void setup() {
  timer = millis();
  Serial.begin(9600);

  pinMode(13, OUTPUT);
  pinMode(A0, INPUT);
  digitalWrite(13, HIGH);
}

void loop() {
  if(analogRead(A0) >= 1003){
    
	double cap = (millis()-timer)/3912023.0;
	
    Serial.print(cap, 10);
    Serial.print(" ");
    Serial.println(millis()-timer);
	
    digitalWrite(13, LOW);
    while(analogRead(A0) > 0){}
    timer = millis();    
    digitalWrite(13, HIGH);
  }
}
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
