<?xml version="1.0" encoding="utf-8" ?>
<soap:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">
    <soap:Header>
        <AuthenticationHeader xmlns="http://www.travel.domain/">
            <AgentUserId>1030</AgentUserId>
            <LoginName>wtb1030</LoginName>
            <Password>wtb1030</Password>
            <IPAddress>100.100.100.100</IPAddress>
        </AuthenticationHeader>
    </soap:Header>
    <soap:Body>
        <ProcessXML xmlns="http://www.travel.domain/">
            <RequestInfo>
                <MappingRequest>
                    <RequestAuditInfo>
                        <RequestType>PXML_SupplierMappingByType</RequestType>
                        <RequestTime>2014-10-10T07:00:00</RequestTime>
                        <RequestResource>ota</RequestResource>
                    </RequestAuditInfo>
                    <RequestParameters>
                        <MappingData>
                            <MappingDetailsData srno="1" mappingtype="countrysupplier">

                                <SupplierCode>RZLVX</SupplierCode>
                                <Active>True</Active>
                                <Exclude>False</Exclude>
                                
                                <CountryCode>TH</CountryCode>
                                
                                <SupplierCountryCode>Thailand1</SupplierCountryCode>
                                

                            </MappingDetailsData>
                        </MappingData>
                    </RequestParameters>
                </MappingRequest>
            </RequestInfo>
        </ProcessXML>
    </soap:Body>
</soap:Envelope>