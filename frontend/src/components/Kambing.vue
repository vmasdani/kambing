<script setup lang="ts">
import { ref } from "vue";
import { fetchKambings, parseCategory } from "../helpers";

const kambings = ref([] as any[]);

const fetchKambingsData = async () => {
  const d = await fetchKambings();

  if (d) {
    kambings.value = d;
  }
};

fetchKambingsData();
</script>

<template>
  <div>
    <a href="/#/kambings/new"
      ><button class="btn btn-sm btn-primary">Add</button></a
    >
  </div>
  <div>
    <div><h4>List Kambing</h4></div>
  </div>

  <div>
    <select>
      <option :value="0">Kecil</option>
      <option :value="1">Sedang</option>
      <option :value="2">Super</option>
    </select>
  </div>
  <div class="d-flex justify-content-around flex-wrap">
    <div v-for="k in kambings">
      <div class="bg-secondary" style="height: 25vh; width: 45vw"></div>
      <div>
        <strong>{{ k?.name }}</strong>
      </div>
      <div>
        Rp{{
          Intl.NumberFormat("id-ID", { minimumFractionDigits: 2 }).format(
            k?.price ?? 0
          )
        }}
      </div>
      <div>{{ parseCategory(k?.category) }}</div>
      <div>
        <a
          :href="`https://wa.me/6281295113878?text=${encodeURIComponent(
            `Halo. Saya ingin memesan kambing ${k?.name} tipe ${parseCategory(
              k?.category
            )} seharga Rp${Intl.NumberFormat(`id-ID`, {
              minimumFractionDigits: 2,
            }).format(k?.price ?? 0)}.`
          )}`"
          target="_blank"
        >
          <button class="btn btn-sm btn-success w-100">Order</button>
        </a>
      </div>

      <div class="md-3"><hr class="border border-dark" /></div>
    </div>
  </div>
</template>
