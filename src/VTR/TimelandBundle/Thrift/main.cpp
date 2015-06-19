#include <thrift/server/TSimpleServer.h>
#include <thrift/server/TThreadPoolServer.h>
#include <thrift/server/TThreadedServer.h>
#include <thrift/transport/TServerSocket.h>
#include <thrift/transport/TTransportUtils.h>
#include <thrift/TToString.h>

#include <iostream>
#include <stdexcept>
#include <sstream>

#include "gen-cpp/Timeland.h"

using namespace std;
using namespace apache::thrift;
using namespace apache::thrift::concurrency;
using namespace apache::thrift::protocol;
using namespace apache::thrift::transport;
using namespace apache::thrift::server;

using namespace timeland_thrift;

class TimelandHandler : public TimelandIf {
public:
  TimelandHandler() {}

  void compute(string& result, const string& file_path) {
        cout << "Appel de compute" << endl;
        result = "Et voila le premier resultat";
    }
};

int main() {
  boost::shared_ptr<TProtocolFactory> protocolFactory(new TBinaryProtocolFactory());
  boost::shared_ptr<TimelandHandler> handler(new TimelandHandler());
  boost::shared_ptr<TProcessor> processor(new TimelandProcessor(handler));
  boost::shared_ptr<TServerTransport> serverTransport(new TServerSocket(9090));
  boost::shared_ptr<TTransportFactory> transportFactory(new TBufferedTransportFactory());

  TSimpleServer server(processor, serverTransport, transportFactory, protocolFactory);

  /**
   * Or you could do one of these

  const int workerCount = 4;

  boost::shared_ptr<ThreadManager> threadManager =
    ThreadManager::newSimpleThreadManager(workerCount);
  boost::shared_ptr<PosixThreadFactory> threadFactory =
    boost::shared_ptr<PosixThreadFactory>(new PosixThreadFactory());
  threadManager->threadFactory(threadFactory);
  threadManager->start();
  TThreadPoolServer server(processor,
                           serverTransport,
                           transportFactory,
                           protocolFactory,
                           threadManager);

  TThreadedServer server(processor,
                         serverTransport,
                         transportFactory,
                         protocolFactory);

  */

  cout << "Starting the server..." << endl;
  server.serve();
  cout << "Done." << endl;
  return 0;
}
