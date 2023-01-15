Video içerisinde yapılan sorgu komutları aşağıda yer almaktadır.


+ Hayvanlar Anasayfa / Sağım Anasayfa

Json dosyası ierisindeki bütün kayıtların gösterilmesini sağlamaktadır.

- localhost:3000/records



+ Seçili Hayvan Sayfası / Sağım

++ Günlük Rapor

Json dosyası içerisindeki seçilen hayvanın ilgili gündeki(o günün tarihi)
sağım kayıtlarının gösterilmesini sağlamaktadır.

- localhost:3000/records?animalId=0004&recordTime=2022-11-18


++ Haftalık Rapor

Json dosyası içerisindeki seçilen hayvanın ilgili zamanlardaki(7 günlük/1 haftalık)
sağım kayıtlarının gösterilmesini sağlamaktadır.

- localhost:3000/records?animalId=0004&recordTime_gte=2022-11-11&recordTime_lte=2022-11-17


++ Aylık Rapor

Json dosyası içerisindeki seçilen hayvanın ilgili zamanlardaki(28 günlük/1 aylık)
sağım kayıtlarının gösterilmesini sağlamaktadır.

- localhost:3000/records?animalId=0004&recordTime_gte=2022-10-21&recordTime_lte=2022-11-17



+ Seçili Hayvan Sayfası / Kayıtlar

++ Sağım Bölümü

Json dosyası içerisindeki seçilen hayvanın geçmiş sağım 
kayıtlarının gösterilmesini sağlamaktadır.

- localhost:3000/records?animalId=0004

++ Çalışan Bölümü

Json dosyası içerisindeki seçilen hayvanın geçmiş sağım 
kayıtlarında yer alan(sağımı gerçekleştiren) kişinin bilgilerinin 
gösterilmesini sağlamaktadır.

- localhost:3000/workers/1



+ Sağım / Detaylar Sayfası

Json dosyası içerisindeki, çiftlik içerisinde yer alan ve sağım yapılan hayvanların 
ilgili gündeki(o günün tarihi) sağım kayıtlarının gösterilmesini sağlamaktadır.

- localhost:3000/records?recordTime=2022-11-18&milkLiter_gte=0.1


+ Sağım Sorgu Sayfaları

++ Zaman Aralığı Seçimi

Json dosyası içerisindeki, çiftlik içerisinde yer alan ve sağım yapılan hayvanların 
ilgili zaman aralığındaki sağım kayıtlarının gösterilmesini sağlamaktadır.

- localhost:3000/records?recordTime_gte=2022-11-11&recordTime_lte=2022-11-17

++ Belirli bir gün Seçimi

Json dosyası içerisindeki, çiftlik içerisinde yer alan ve sağım yapılan hayvanların 
ilgili gündeki(spesifik bir tarih) sağım kayıtlarının gösterilmesini sağlamaktadır.

- localhost:3000/records?recordTime=2022-11-18



+ Sağım Yapılmayan Hayvanlar Sayfası

Json dosyası içerisindeki, çiftlik içerisinde yer alan ve sağım yapılmayan hayvanların 
ilgili gündeki(o günün tarihi) sağım kayıtlarının gösterilmesini sağlamaktadır.

- localhost:3000/records?recordTime=2022-11-18&milkLiter=0



+ Çalışanlar Sayfası

Json dosyası içerisindeki, çiftlik içerisinde yer alan çalışanlar ile 
ilgili bilgilerin artan sıra düzeninde gösterilmesini sağlamaktadır.

- localhost:3000/workers?_sort=workerName&_order=asc


