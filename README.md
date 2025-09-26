# udi-parser
### Unique Device Identification Parser

This is a rudimentary reference implementation for parsing UDI numbers as it pertains to the FDAs Unique Device Identification initiative. 

For more information regarding this initiative [see here](http://www.fda.gov/MedicalDevices/DeviceRegulationandGuidance/UniqueDeviceIdentification/)

This parser makes some very hard assumptions on the layout of the UDI data. 

It assumes the application identifiers are laid out in the following fashion: 
   
(01)(10)(11)(17)(21)

Where (17) is optional AND (10) is a fixed length by $lotLength variable. 

