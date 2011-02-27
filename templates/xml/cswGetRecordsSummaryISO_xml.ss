<?xml version="1.0"?>
<csw:GetRecords xmlns:csw="http://www.opengis.net/cat/csw/2.0.2" service="CSW" version="2.0.2" resultType="results" outputSchema="csw:IsoRecord" maxRecords="$maxRecords" startPosition="$startPosition">
    <csw:Query typeNames="gmd:MD_Metadata">
        <csw:ElementSetName>full</csw:ElementSetName>
		<% if WordsToSearchFor %>
        <csw:Constraint version="1.1.0">
            <Filter xmlns="http://www.opengis.net/ogc" xmlns:gml="http://www.opengis.net/gml">
			<And>
				<% control WordsToSearchFor %>
					<PropertyIsLike wildCard="%" singleChar="_" escapeChar="\">
						<PropertyName>AnyText</PropertyName>
						<Literal>%$word%</Literal>
					</PropertyIsLike>
				<% end_control %>
			</And>
            </Filter>
        </csw:Constraint>
		<% end_if %>
		<ogc:SortBy xmlns:ogc="http://www.opengis.net/ogc">
			<ogc:SortProperty>
				<ogc:PropertyName>title</ogc:PropertyName>
						<!--                
						<ogc:PropertyName>popularity</ogc:PropertyName>
						<ogc:PropertyName>rating</ogc:PropertyName>
						<ogc:PropertyName>date</ogc:PropertyName>
						-->
				<ogc:SortOrder>ASC</ogc:SortOrder>
				</ogc:SortProperty>
        </ogc:SortBy>
    </csw:Query>
</csw:GetRecords>
