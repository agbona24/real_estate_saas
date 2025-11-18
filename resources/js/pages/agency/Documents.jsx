import React from 'react';
import {
    Box,
    Button,
    Heading,
    Table,
    Thead,
    Tbody,
    Tr,
    Th,
    Td,
    Badge,
    IconButton,
    useColorModeValue,
    HStack,
    Text,
    Select,
} from '@chakra-ui/react';
import { Plus, Eye, Download, Trash2, FileText, File, Image as ImageIcon } from 'lucide-react';

const Documents = () => {
    const bgColor = useColorModeValue('white', 'gray.800');

    const documents = [
        {
            id: 1,
            name: 'Purchase Agreement - 123 Main St',
            type: 'contract',
            category: 'Transaction',
            relatedTo: 'TXN-001',
            uploadedBy: 'Sarah Johnson',
            size: '2.4 MB',
            date: '2025-11-15',
            status: 'signed',
        },
        {
            id: 2,
            name: 'Property Inspection Report',
            type: 'pdf',
            category: 'Inspection',
            relatedTo: '456 Oak Ave',
            uploadedBy: 'Michael Chen',
            size: '1.8 MB',
            date: '2025-11-14',
            status: 'pending_review',
        },
        {
            id: 3,
            name: 'Title Deed - 789 Pine Rd',
            type: 'pdf',
            category: 'Legal',
            relatedTo: 'TXN-003',
            uploadedBy: 'Sarah Johnson',
            size: '856 KB',
            date: '2025-11-12',
            status: 'approved',
        },
        {
            id: 4,
            name: 'Client ID - John Smith',
            type: 'image',
            category: 'Client Document',
            relatedTo: 'John Smith',
            uploadedBy: 'David Kim',
            size: '1.2 MB',
            date: '2025-11-10',
            status: 'verified',
        },
        {
            id: 5,
            name: 'Listing Agreement - 654 Maple Dr',
            type: 'contract',
            category: 'Listing',
            relatedTo: '654 Maple Dr',
            uploadedBy: 'Jessica Martinez',
            size: '945 KB',
            date: '2025-11-08',
            status: 'active',
        },
        {
            id: 6,
            name: 'Financial Pre-Approval Letter',
            type: 'pdf',
            category: 'Financial',
            relatedTo: 'Emily Davis',
            uploadedBy: 'Michael Chen',
            size: '324 KB',
            date: '2025-11-07',
            status: 'approved',
        },
        {
            id: 7,
            name: 'Property Photos - Penthouse',
            type: 'image',
            category: 'Marketing',
            relatedTo: '987 Tower Blvd',
            uploadedBy: 'David Kim',
            size: '15.6 MB',
            date: '2025-11-05',
            status: 'published',
        },
        {
            id: 8,
            name: 'Home Warranty Certificate',
            type: 'pdf',
            category: 'Warranty',
            relatedTo: 'TXN-004',
            uploadedBy: 'Sarah Johnson',
            size: '678 KB',
            date: '2025-11-03',
            status: 'active',
        },
    ];

    const getFileIcon = (type) => {
        switch (type) {
            case 'image':
                return ImageIcon;
            case 'contract':
                return FileText;
            default:
                return File;
        }
    };

    return (
        <Box>
            <HStack justify="space-between" mb={8}>
                <Heading>Documents</Heading>
                <HStack spacing={3}>
                    <Select placeholder="All categories" w="180px">
                        <option value="transaction">Transaction</option>
                        <option value="inspection">Inspection</option>
                        <option value="legal">Legal</option>
                        <option value="client">Client Document</option>
                        <option value="listing">Listing</option>
                        <option value="financial">Financial</option>
                        <option value="marketing">Marketing</option>
                        <option value="warranty">Warranty</option>
                    </Select>
                    <Button leftIcon={<Plus size={20} />} colorScheme="blue">
                        Upload Document
                    </Button>
                </HStack>
            </HStack>

            <Box bg={bgColor} p={6} borderRadius="xl" shadow="sm">
                <Table variant="simple">
                    <Thead>
                        <Tr>
                            <Th>Document Name</Th>
                            <Th>Category</Th>
                            <Th>Related To</Th>
                            <Th>Uploaded By</Th>
                            <Th>Size</Th>
                            <Th>Date</Th>
                            <Th>Status</Th>
                            <Th>Actions</Th>
                        </Tr>
                    </Thead>
                    <Tbody>
                        {documents.map((doc) => (
                            <Tr key={doc.id}>
                                <Td>
                                    <HStack spacing={2}>
                                        {React.createElement(getFileIcon(doc.type), { size: 18 })}
                                        <Text fontWeight="semibold" fontSize="sm">
                                            {doc.name}
                                        </Text>
                                    </HStack>
                                </Td>
                                <Td>
                                    <Badge>{doc.category}</Badge>
                                </Td>
                                <Td fontSize="sm">{doc.relatedTo}</Td>
                                <Td fontSize="sm">{doc.uploadedBy}</Td>
                                <Td fontSize="sm">{doc.size}</Td>
                                <Td fontSize="sm">{doc.date}</Td>
                                <Td>
                                    <Badge
                                        colorScheme={
                                            doc.status === 'signed' || doc.status === 'approved' || doc.status === 'verified'
                                                ? 'green'
                                                : doc.status === 'pending_review'
                                                ? 'yellow'
                                                : 'blue'
                                        }
                                    >
                                        {doc.status.replace('_', ' ')}
                                    </Badge>
                                </Td>
                                <Td>
                                    <HStack spacing={2}>
                                        <IconButton
                                            icon={<Eye size={16} />}
                                            size="sm"
                                            colorScheme="blue"
                                            variant="ghost"
                                            aria-label="View document"
                                        />
                                        <IconButton
                                            icon={<Download size={16} />}
                                            size="sm"
                                            colorScheme="green"
                                            variant="ghost"
                                            aria-label="Download document"
                                        />
                                        <IconButton
                                            icon={<Trash2 size={16} />}
                                            size="sm"
                                            colorScheme="red"
                                            variant="ghost"
                                            aria-label="Delete document"
                                        />
                                    </HStack>
                                </Td>
                            </Tr>
                        ))}
                    </Tbody>
                </Table>
            </Box>
        </Box>
    );
};

export default Documents;
