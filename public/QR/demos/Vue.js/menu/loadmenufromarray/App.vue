<template>
    <div style="float: left;">
        <JqxMenu :source="source"
                 :mode="'vertical'"
                 :width="180"
                 :height="180">
        </JqxMenu>
    </div>
</template>
<script>
    import JqxMenu from "jqwidgets-scripts/jqwidgets-vue/vue_jqxmenu.vue"

    export default {
        components: {
            JqxMenu
        },
        data: function () {
            return {
                source: [
                    {
                        html: "<img src='../../../images/mailIcon.png'/><span style='position: relative; left: 3px; top: -2px;'>Mail</span>",
                        items: [
                            { html: "<img src='../../../images/calendarIcon.png'/><span style='position: relative; left: 3px; top: -2px;'>Calendar</span>" },
                            { html: "<img src='../../../images/contactsIcon.png'/><span style='position: relative; left: 3px; top: -2px;'>Contacts</span>" }
                        ]
                    },
                    {
                        html: "<img src='../../../images/folder.png'/><span style='position: relative; left: 3px; top: -2px;'>Inbox</span>",
                        items: [
                            { html: "<img src='../../../images/folder.png'/><span style='position: relative; left: 3px; top: -2px;'>Admin</span>" },
                            { html: "<img src='../../../images/folder.png'/><span style='position: relative; left: 3px; top: -2px;'>Corporate</span>" },
                            { html: "<img src='../../../images/folder.png'/><span style='position: relative; left: 3px; top: -2px;'>Finance</span>" },
                            { html: "<img src='../../../images/folder.png'/><span style='position: relative; left: 3px; top: -2px;'>Other</span>" }]
                    },
                    { html: "<img src='../../../images/recycle.png'/><span style='position: relative; left: 3px; top: -2px;'>Deleted Items</span>" },
                    { html: "<img src='../../../images/notesIcon.png'/><span style='position: relative; left: 3px; top: -2px;'>Notes</span>" },
                    { html: "<img src='../../../images/settings.png'/><span style='position: relative; left: 3px; top: -2px;'>Settings</span>" },
                    { html: "<img src='../../../images/favorites.png'/><span style='position: relative; left: 3px; top: -2px;'>Favorites</span>" }
                ]
            }
        }
    }
</script>

<style>
</style>
