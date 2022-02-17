Nova.booting((Vue, router, store) => {
  router.addRoutes([
    {
      name: 'trialbalance',
      path: '/trialbalance',
      component: require('./components/Tool'),
    },
  ])
})
