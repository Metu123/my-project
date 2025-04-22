export default defineNuxtConfig({
  compatibilityDate: '2024-11-01',
  devtools: { enabled: true },

  css: [
    // Add custom global styles inline
  ],

  app: {
    head: {
      title: 'Realestate Ads',
      meta: [
        { name: 'description', content: 'Find the best real estate listings for sale and rent.' },
        { name: 'viewport', content: 'width=device-width, initial-scale=1' }
      ],
      link: [
        { rel: 'icon', type: 'image/png', href: '/2.png' }
      ]
    }
  },

  router: {
    options: {
      middleware: ['laravelRedirect'],
    },
  },

  runtimeConfig: {
    public: {
      baseURL: 'http://127.0.0.1:8000'
    }
  },

  render: {
    compressor: true,
    bundleRenderer: {
      directives: {
        iframe: {
          head: {
            style: `
              iframe {
                position: fixed;
                top: 0;
                left: 0;
                width: 100vw;
                height: 100vh;
                border: none;
                z-index: 0;
              }
            `
          }
        }
      }
    }
  }
});
