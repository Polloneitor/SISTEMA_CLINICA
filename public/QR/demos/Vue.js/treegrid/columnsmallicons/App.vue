<template>
    <JqxTreeGrid ref="myTreeGrid"
        :width="width"
        :sortable="true"
        :icons="true"
        :ready="ready"
        :columns="columns"
        :source="dataAdapter">
    </JqxTreeGrid>
</template>

<script>
    import JqxTreeGrid from 'jqwidgets-scripts/jqwidgets-vue/vue_jqxtreegrid.vue';
    
    export default {
        components: {
            JqxTreeGrid
        },
        data: function () {
            return {
                width: '90%',
                dataAdapter: new jqx.dataAdapter(this.source),
                columns: [
                    { text: 'FirstName', dataField: 'FirstName', width: 200 },
                    { text: 'LastName', dataField: 'LastName', width: 200 },
                    { text: 'Title', dataField: 'Title', width: 200 },
                    { text: 'Birth Date', dataField: 'BirthDate', cellsFormat: 'd', width: 120 },
                    { text: 'Hire Date', dataField: 'HireDate', cellsFormat: 'd', width: 120 },
                    { text: 'Address', dataField: 'Address', width: 250 },
                    { text: 'City', dataField: 'City', width: 100 },
                    {
                        text: 'Country', dataField: 'Country', width: 63,
                        cellsRenderer: (rowKey, dataField, value, data) => {
                            switch (value) {
                                case "USA":
                                    return "<div style='margin: 0px 20px;'><img style='margin-top: 2px;' width='16' height='16' src='../../../images/usa.png'/></div>";
                                case "UK":
                                    return "<div style='margin: 0px 20px;'><img style='margin-top: 2px;' width='16' height='16' src='../../../images/uk.png'/></div>";
                            }
                        }
                    }
                ]
            }
        },        
        beforeCreate: function () {
            let employees = [
                {
                    "EmployeeID": 2, "icon": '../../../images/oldboss.png', "FirstName": "Andrew", "LastName": "Fuller", "Country": "USA", "Title": "Vice President, Sales", "HireDate": "1992-08-14 00:00:00", "BirthDate": "1952-02-19 00:00:00", "City": "Tacoma", "Address": "908 W. Capital Way", "expanded": "true",
                    "children":
                    [
                        { "EmployeeID": 8, "icon": '../../../images/woman.png', "FirstName": "Laura", "LastName": "Callahan", "Country": "USA", "Title": "Inside Sales Coordinator", "HireDate": "1994-03-05 00:00:00", "BirthDate": "1958-01-09 00:00:00", "City": "Seattle", "Address": "4726 - 11th Ave. N.E." },
                        { "EmployeeID": 1, "icon": '../../../images/woman.png', "FirstName": "Nancy", "LastName": "Davolio", "Country": "USA", "Title": "Sales Representative", "HireDate": "1992-05-01 00:00:00", "BirthDate": "1968-12-08 00:00:00", "City": "Seattle", "Address": "507 - 20th Ave. E.Apt. 2A" },
                        { "EmployeeID": 3, "icon": '../../../images/woman.png', "FirstName": "Janet", "LastName": "Leverling", "Country": "USA", "Title": "Sales Representative", "HireDate": "1992-04-01 00:00:00", "BirthDate": "1963-08-30 00:00:00", "City": "Kirkland", "Address": "722 Moss Bay Blvd." },
                        { "EmployeeID": 4, "icon": '../../../images/woman.png', "FirstName": "Margaret", "LastName": "Peacock", "Country": "USA", "Title": "Sales Representative", "HireDate": "1993-05-03 00:00:00", "BirthDate": "1967-09-19 00:00:00", "City": "Redmond", "Address": "4110 Old Redmond Rd." },
                        {
                            "EmployeeID": 5, "icon": '../../../images/boss.png', "FirstName": "Steven", "LastName": "Buchanan", "Country": "UK", "Title": "Sales Manager", "HireDate": "1993-10-17 00:00:00", "BirthDate": "1955-03-04 00:00:00", "City": "London", "Address": "14 Garrett Hill", "expanded": "true",
                            "children":
                            [
                                { "EmployeeID": 6, "icon": '../../../images/asian.png', "FirstName": "Michael", "LastName": "Suyama", "Country": "UK", "Title": "Sales Representative", "HireDate": "1993-10-17 00:00:00", "BirthDate": "1963-07-02 00:00:00", "City": "London", "Address": "Coventry House Miner Rd." },
                                { "EmployeeID": 7, "icon": '../../../images/person.png', "FirstName": "Robert", "LastName": "King", "Country": "UK", "Title": "Sales Representative", "HireDate": "1994-01-02 00:00:00", "BirthDate": "1960-05-29 00:00:00", "City": "London", "Address": "Edgeham Hollow Winchester Way" },
                                { "EmployeeID": 9, "icon": '../../../images/woman.png', "FirstName": "Anne", "LastName": "Dodsworth", "Country": "UK", "Title": "Sales Representative", "HireDate": "1994-11-15 00:00:00", "BirthDate": "1966-01-27 00:00:00", "City": "London", "Address": "7 Houndstooth Rd." }
                            ]
                        },
                        {
                            "EmployeeID": 10, "icon": '../../../images/asian.png', "FirstName": "Fumi", "LastName": "Jinushi", "Country": "UK", "Title": "Sales Manager", "HireDate": "1994-11-15 00:00:00", "BirthDate": "1954-02-03 00:00:00", "City": "London", "Address": "14 Garrett Hill",
                            "children":
                            [
                                { "EmployeeID": 11, "icon": '../../../images/person.png', "FirstName": "Michael", "LastName": "Davidson", "Country": "UK", "Title": "Sales Representative", "HireDate": "1996-10-17 00:00:00", "BirthDate": "1973-07-02 00:00:00", "City": "London", "Address": "Coventry House Miner Rd." },
                                { "EmployeeID": 12, "icon": '../../../images/person.png', "FirstName": "Peter", "LastName": "Smith", "Country": "UK", "Title": "Sales Representative", "HireDate": "1998-01-02 00:00:00", "BirthDate": "1970-05-29 00:00:00", "City": "London", "Address": "Edgeham Hollow Winchester Way" },
                            ]
                        },
                        { "EmployeeID": 13, "icon": '../../../images/person.png', "FirstName": "Chris", "LastName": "Ferguson", "Country": "USA", "Title": "Sales Representative", "HireDate": "2009-05-03 00:00:00", "BirthDate": "1967-09-19 00:00:00", "City": "Redmond", "Address": "4115 Old Redmond Rd." },
                        { "EmployeeID": 14, "icon": '../../../images/person.png', "FirstName": "Antoni", "LastName": "Brooke", "Country": "USA", "Title": "Sales Representative", "HireDate": "2010-05-03 00:00:00", "BirthDate": "1985-09-19 00:00:00", "City": "Redmond", "Address": "4210 Old Redmond Rd." },
                    ]
                }
            ];
            
            // prepare the data
            this.source = {
                dataType: "json",
                dataFields: [
                    { name: 'EmployeeID', type: 'number' },
                    { name: 'FirstName', type: 'string' },
                    { name: 'LastName', type: 'string' },
                    { name: 'Country', type: 'string' },
                    { name: 'City', type: 'string' },
                    { name: 'Address', type: 'string' },
                    { name: 'Title', type: 'string' },
                    { name: 'icon', type: 'string' },
                    { name: 'HireDate', type: 'date' },
                    { name: 'children', type: 'array' },
                    { name: 'expanded', type: 'bool' },
                    { name: 'BirthDate', type: 'date' }
                ],
                hierarchy:
                {
                    root: 'children'
                },
                id: 'EmployeeID',
                localData: employees
            };
        }, 
        methods: {
            ready: function () {
                this.$refs.myTreeGrid.expandRow(2);
            }
        }
    }
</script>

<style>
    .jqx-tree-grid-icon, .jqx-tree-grid-icon-size {
        width: 16px;
        height: 16px;
    }
</style>
