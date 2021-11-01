const apiUrl = 'http://localhost:8081'

new Vue({
    el: '#app',
    data: {
        devices: [],
        deviceTypes: {},
        oss: {},
        sortByHostname: null,
        sortByOwner: null,
        addDeviceFormShown: false,
        addDeviceForm: {
            hostname: '',
            device_type_id: null,
            os_id: null,
            owner: ''
        }
    },
    mounted() {
        this.loadDevices()
        this.loadEnums()
    },
    computed: {
        sortedDevices() {
            return this.devices.sort((itemA, itemB) => {
                if (this.sortByHostname) {
                    if (this.sortByHostname === 'ASC') {
                        return itemA.hostname > itemB.hostname ? 1 : -1
                    } else if (this.sortByHostname === 'DESC') {
                        return itemA.hostname > itemB.hostname ? -1 : 1
                    }
                } else if (this.sortByOwner) {
                    if (this.sortByOwner === 'ASC') {
                        return itemA.owner > itemB.owner ? 1 : -1
                    } else if (this.sortByOwner === 'DESC') {
                        return itemA.owner > itemB.owner ? -1 : 1
                    }
                }
            })
        }
    },
    methods: {
        loadDevices() {
            axios.get(apiUrl + '/devices')
                .then(res => {
                    this.devices = res.data
                    this.addDeviceFormShown = false
                })
        },

        loadEnums() {
            axios.get(apiUrl + '/device_types')
                .then(res => {
                    this.deviceTypes = res.data
                })

            axios.get(apiUrl + '/os')
                .then(res => {
                    this.oss = res.data
                })
        },

        changeSortByHostname() {
            this.sortByOwner = null
            if (this.sortByHostname === 'ASC') {
                this.sortByHostname = 'DESC';
            } else {
                this.sortByHostname = 'ASC';
            }
        },

        changeSortByOwner() {
            this.sortByHostname = null
            if (this.sortByOwner === 'ASC') {
                this.sortByOwner = 'DESC';
            } else {
                this.sortByOwner = 'ASC';
            }
        },

        showAddDeviceForm() {
            this.addDeviceFormShown = true
        },

        postDevice() {
            axios.post(apiUrl + '/devices', this.addDeviceForm)
                .then(() => {
                    this.loadDevices()
                })
        }
    }
})

