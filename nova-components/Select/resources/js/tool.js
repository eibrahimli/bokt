Nova.booting((Vue, router, store) => {
  router.addRoutes([
    {
      name: 'select',
      path: '/select',
      component: require('./components/Tool'),
    },
  ])
})
