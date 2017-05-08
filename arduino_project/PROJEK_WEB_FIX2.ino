#include <DHT.h>
#include <Ethernet.h>
#include <SPI.h>

byte mac[] = {
  0xDE, 0xAD, 0xBE, 0xEF, 0xFE, 0xED
};
IPAddress ip(192, 168, 10, 13);
EthernetServer server(80);

#define DHTPIN 2 // SENSOR PIN
#define DHTTYPE DHT11 // SENSOR TYPE - THE ADAFRUIT LIBRARY OFFERS SUPPORT FOR MORE MODELS
DHT dht(DHTPIN, DHTTYPE);

long previousMillis = 0;
unsigned long currentMillis = 0;
long interval = 1000; 

int t = 0;    // suhu var
int h = 0;    // kelembapan var
int l = 0;    // cahaya var
int LDR = A2; //input pin analog2
String data;


void setup() { 
  Serial.begin(9600);

 // start the Ethernet connection and the server:
  Ethernet.begin(mac, ip);
  server.begin();
  Serial.print("server is at ");
  Serial.println(Ethernet.localIP());

  dht.begin(); 
  delay(1000); 

  h = (int) dht.readHumidity(); 
  t = (int) dht.readTemperature(); 

  data = "";
}

void loop(){

  l = analogRead(LDR);
  l = map(l, 0, 1023, 0, 100);
  currentMillis = millis();
  if(currentMillis - previousMillis > interval) { 
    previousMillis = currentMillis;
    h = (int) dht.readHumidity();
    t = (int) dht.readTemperature();
    
}

  data  = "suhu=" + (String(t)) + "&kelembapan=" + (String(h)) + "&&cahaya= " + (String(l));
  Serial.println (data);

  EthernetClient client = server.available();
  if (client.connect("192.168.10.12",80)) { // REPLACE WITH YOUR SERVER ADDRESS
    client.println("POST /standar_ci/public/sensor/device/add HTTP/1.1"); 
    client.println("Host:192.168.10.12"); // SERVER ADDRESS HERE TOO
    client.println("Content-Type: application/x-www-form-urlencoded"); 
    client.print("Content-Length: "); 
    client.println(data.length()); 
    client.println(); 
    client.print(data); 
  } 

  if (client.connected()) { 
    client.stop();  // 
  }

  delay(1000); // 
}



