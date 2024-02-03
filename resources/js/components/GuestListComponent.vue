<template>
    <div class="w-100">
        <div class="guest-header mb-3">
            <h2>GuestBook</h2>
            <input type="text" class="form-input input-search" placeholder="nama anda..." :value="search" @input="searchGuest" />
        </div>
        <div v-if="loading" class="text-center">
            <div class="spinner-border" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>
        <div v-else>
            <div v-if="guests.length > 0" class="guest-list">
                <div :class="{ 'guest-item shadow active': guest.status === '1', 'guest-item shadow': guest.status === '0' }" @click="getItem(guest.id)" v-for="guest in guests" :key="guest.id" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    <div>{{ guest.name }}</div>
                </div>
            </div>
            <div v-else class="text-center">
                Tidak ada data.
            </div>
        </div>
    </div>

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div :class="{ 'modal-content active': item.status === '1', 'modal-content': item.status === '0' }">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{ item.name }}</h5>
                    <button type="button" class="btn-close" @click="closeModal" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-2">
                        <div>{{ item.email }}</div>
                        <div>{{ item.address }}</div>
                    </div>
                    <textarea class="input-message w-100" rows="5" placeholder="Tulis pesanmu..." v-model="message"></textarea>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" @click="closeModal" data-bs-dismiss="modal">Tutup</button>
                    <button v-if="item.status === '0'" type="button" class="btn btn-primary" @click="sendAttendance" data-bs-dismiss="modal">Saya Hadir</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    data() {
        return {
            guests: [],
            search: '',
            loading: true,
            item: {},
            attendance: {},
            message: ''
        };
    },
    methods: {
        getGuests() {
            this.loading = true;
            axios.get('/api/guests', {
                params: {
                    search: this.search
                }
            })
            .then(response => {
                this.guests = response.data.data;
                this.loading = false;
            })
            .catch(error => {
                console.error(error);
            });
        },
        getAttendance() {
            axios.get(`/api/attendance/${this.item.id}`)
            .then(response => {
                this.message = response.data.data.message;
            })
            .catch(error => {
                console.error(error);
            });
        },
        searchGuest(event) {
            this.search = event.target.value;
            this.getGuests();
        },
        getItem(id) {
            this.item = this.guests.find(item => item.id === id);
            this.getAttendance();
        },
        sendAttendance() {
            axios.post('/api/guests', {
                "guest_id": this.item.id,
                "message": this.message
            })
            .then(() => {
                this.getGuests();
                this.message = '';
            })
            .catch(error => {
                console.error(error);
            });
        },
        closeModal() {
            this.message = '';
        }
    },
    mounted() {
        this.getGuests();
    },
};
</script>

<style>
    .guest-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    .input-search {
        padding: .5rem 1rem;
        border-radius: 5px;
        margin-bottom: 1rem;
        min-width: 250px;
        border: none;
        background-color: #ececec;
    }
    .input-message {
        padding: 1rem;
        border-radius: 5px;
        margin-bottom: 1rem;
        min-width: 250px;
        border: none;
        background-color: #ececec;
    }
    .guest-list {
        display: grid;
        grid-template-columns: repeat( auto-fit, minmax(200px, 1fr) );
        gap: 2rem;
    }
    .guest-item {
        display: flex;
        flex-direction: column;
        align-items: center;
        border-radius: 8px;
        padding: 1rem;
        cursor: pointer;
        transition: all .2s ease-in;
    }
    .guest-item:hover {
        transform: scale(1.05);
    }
    .guest-item.active {
        border-bottom: 3px solid #198754;
    }
    .modal-content {
        border-radius: 15px;
    }
    .modal-content.active {
        border-top: 5px solid #198754;
    }
    @media (max-width: 576px) {
        .guest-header {
            display: flex;
            flex-direction: column;
            align-items: center;
        }
    }
</style>
